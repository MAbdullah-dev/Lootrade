<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Raffle;
use App\Models\RaffleTicket;


class Battlefield extends Component
{
    public $gameStarted = false;
    public $tickets;
    public $currentRound = 0;
    public $userScore = 0;
    public $botScore = 0;
    public $userTower = [];
    public $botTower = [];
    public $userCurrentRow = 0;
    public $botCurrentRow = 0;
    public $turn = null;
    public $firstPlayer = 'user';
    public $playersTurnsTaken = [];
    public $progress = [];
    public $gameWinner = null;
    public $userRowStates = [];
    public $botRowStates = [];
    public $raffle;
    public $user;
    public $usedTicketIds;

    protected $listeners = [
        'botTurn' => 'handleBotTurn',
        'endRound' => 'endRound',
    ];

    public function mount(Raffle $raffle)
    {
        $this->user = Auth::user();
        $this->raffle = $raffle;
        $this->raffle->prize = json_decode($this->raffle->prize, true);
        $this->tickets = auth()->user()->ticket_balance;
        $this->userRowStates = [];
        $this->botRowStates = [];
    }

    public function redirectBackToRaffle()
    {
        return redirect("raffle/{$this->raffle->id}");
    }


    public function startGame()
    {
        $user = $this->user;

        $alreadySecured = RaffleTicket::where('user_id', $user->id)
            ->where('raffle_id', $this->raffle->id)
            ->count();

        $maxAllowed = $this->raffle->max_entries_per_user ?? PHP_INT_MAX;
        $remainingAllowed = $maxAllowed - $alreadySecured;

        if ($remainingAllowed < 5) {
            alert_error("🎟️ Winning this game secures 5 entries in the raffle, and you currently have {$remainingAllowed} entries left.");
            return;
        }

        $userHasEntries = RaffleTicket::where('raffle_id', $this->raffle->id)
            ->where('user_id', $user->id)
            ->exists();

        if (!$userHasEntries && $this->raffle->slots <= 0) {
            alert_error('Raffle is full. No slots left.');
            return;
        }

        if ($this->tickets < 10) {
            alert_error('Not enough tickets!');
            return;
        }

        DB::beginTransaction();

        try {
            // Lock and get 10 available user tickets
            $tickets = \App\Models\UserTicket::where('user_id', $user->id)
                ->where('status', 'available')
                ->lockForUpdate()
                ->limit(10)
                ->get();

            if ($tickets->count() < 10) {
                DB::rollBack();
                alert_error('You do not have 10 available tickets to start this game.');
                return;
            }

            // Mark all 10 tickets as consumed
            \App\Models\UserTicket::whereIn('id', $tickets->pluck('id'))
                ->update(['status' => 'consumed']);

            // Store IDs if needed
            $this->usedTicketIds = $tickets->pluck('id')->toArray();

            $user->decrement('ticket_balance', 10);

            if (!$userHasEntries) {
                $this->raffle->decrement('slots');
            }

            DB::commit();

            $this->tickets = $user->fresh()->ticket_balance;

            // INIT Battlefield game
            $this->gameStarted = true;
            $this->currentRound = 1;
            $this->userScore = 0;
            $this->botScore = 0;
            $this->progress = [];
            $this->gameWinner = null;
            $this->firstPlayer = rand(0, 1) ? 'user' : 'bot';
            $this->turn = $this->firstPlayer;

            Log::debug('Game started. First player: ' . $this->firstPlayer . ', New ticket count: ' . $this->tickets);

            $this->initializeRound();

            if ($this->turn == 'bot') {
                $this->dispatch('bot-move', ['continue' => true]);
            }

            $this->dispatch('play-sound', sound: 'play');

        } catch (\Exception $e) {
            DB::rollBack();
            alert_error('Failed to start game. Try again.');
        }
    }

    public function initializeRound()
    {
        $this->userTower = $this->generateTower();
        $this->botTower = $this->generateTower();
        $this->userCurrentRow = 0;
        $this->botCurrentRow = 0;
        $this->userRowStates = [];
        $this->botRowStates = [];
        $this->playersTurnsTaken = [];
        $this->progress[$this->currentRound] = ['user' => 0, 'bot' => 0];
        $this->turn = $this->firstPlayer;
        Log::debug('Round ' . $this->currentRound . ' initialized. Turn: ' . $this->turn);

        if ($this->turn == 'bot') {
            // $this->handleBotTurn();
            $this->dispatch('bot-move', ['continue' => true]);
        }
    }

    private function generateTower()
    {
        $tower = [];
        for ($row = 0; $row < 5; $row++) {
            $correctIndex = rand(0, 1);
            $tower[$row] = [
                0 => ['correct' => $correctIndex == 0, 'selected' => false, 'wrong' => false],
                1 => ['correct' => $correctIndex == 1, 'selected' => false, 'wrong' => false],
            ];
        }
        return $tower;
    }

    public function selectTicket($player, $row, $ticketIndex)
    {
        if ($this->gameWinner || $this->turn != $player || $this->{$player . 'CurrentRow'} != $row) {
            return;
        }

        $tower = $player . 'Tower';
        $rowStatesProp = $player . 'RowStates';

        if (!isset($this->$rowStatesProp[$row])) {
            $this->$rowStatesProp[$row] = false;
        }

        $this->$tower[$row][$ticketIndex]['selected'] = true;

        $isCorrect = $this->$tower[$row][$ticketIndex]['correct'];

        if ($player === 'user') {
            $isCorrect = rand(1, 100) <= 40;
        }

        if ($isCorrect) {
            $this->$tower[$row][0]['selected'] = true;
            $this->$tower[$row][1]['selected'] = true;
            $this->$rowStatesProp[$row] = true;
            $this->dispatch('play-sound', sound: 'correct');
            $this->{$player . 'CurrentRow'}++;

            if ($this->{$player . 'CurrentRow'} == 5) {
                $this->gameWinner = $player;
                if ($player === 'user') {
                    $this->awardRaffleTickets();
                }
                return;
            }
            if ($player == 'bot') {
                $this->dispatch('bot-move', ['continue' => true]);
            }
        } else {
            $this->$tower[$row][$ticketIndex]['wrong'] = true;
            $this->$rowStatesProp[$row] = false;
            $this->dispatch('play-sound', sound: 'wrong');
            $this->endTurn($player);
        }
    }


    private function botSelectTicket()
    {
        if ($this->gameWinner || $this->turn != 'bot') {
            return false;
        }

        $row = $this->botCurrentRow;
        $knowsCorrect = rand(1, 100) <= 60;
        $ticketIndex = $knowsCorrect ? array_search(true, array_column($this->botTower[$row], 'correct')) : rand(0, 1);

        $this->selectTicket('bot', $row, $ticketIndex);
        return $this->botCurrentRow < 5 && $this->botTower[$row][$ticketIndex]['correct'] && !$this->gameWinner;
    }

    public function handleBotTurn()
    {
        $this->botSelectTicket();
    }

    private function endTurn($player)
    {
        $this->progress[$this->currentRound][$player] = $this->{$player . 'CurrentRow'};
        $this->playersTurnsTaken[] = $player;
        $this->turn = ($player == 'user') ? 'bot' : 'user';
        Log::debug('Turn ended for ' . $player . '. Next turn: ' . $this->turn);

        if ($this->turn == 'bot') {
            $this->dispatch('bot-move', ['continue' => true]);
        }

        if (count($this->playersTurnsTaken) == 2) {
            $this->dispatch('end-round');
        }
    }

    public function endRound()
    {
        $userProgress = $this->progress[$this->currentRound]['user'];
        $botProgress = $this->progress[$this->currentRound]['bot'];
        $this->userScore += $userProgress;
        $this->botScore += $botProgress;

        if ($this->currentRound == 20) {
            $this->gameWinner = $this->userScore > $this->botScore ? 'user' : ($this->botScore > $this->userScore ? 'bot' : 'tie');
            if ($this->gameWinner === 'user') {
            $this->awardRaffleTickets();
            }
        } else {
            $this->currentRound++;
            $this->initializeRound();
        }
    }

    private function awardRaffleTickets()
    {
        $user = $this->user;

        $alreadySecured = RaffleTicket::where('user_id', $user->id)
            ->where('raffle_id', $this->raffle->id)
            ->count();

        $maxAllowed = $this->raffle->max_entries_per_user ?? PHP_INT_MAX;
        $remainingAllowed = $maxAllowed - $alreadySecured;

        $entriesToGive = min(5, $remainingAllowed);

        if ($entriesToGive <= 0) {
            return;
        }

        $userHasEntries = $alreadySecured > 0;

        $availableTicketIds = array_slice($this->usedTicketIds ?? [], 0, $entriesToGive);
        $userTickets = \App\Models\UserTicket::whereIn('id', $availableTicketIds)->get()->keyBy('id');

        $entries = [];

        foreach ($availableTicketIds as $id) {
            $ticket = $userTickets[$id] ?? null;
            $entries[] = [
                'raffle_id' => $this->raffle->id,
                'user_id' => $user->id,
                'ticket_number' => $ticket?->ticket_number,
                'user_ticket_id' => $ticket?->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        RaffleTicket::insert($entries);

        if (!$userHasEntries) {
            $this->raffle->decrement('slots');
        }
    }

    public function render()
    {
        return view('livewire.pages.battlefield')->layout('components.layouts.app');
    }
}

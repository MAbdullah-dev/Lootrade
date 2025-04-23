<?php

namespace App\Livewire\Pages;

use App\Models\Raffle;
use App\Models\RaffleTicket;
use App\Models\UserTicket;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RaffleDetail extends Component
{
    public $id;
    public $raffle;
    public $lastUserJoined;
    public $joinTicketsCount = 1;
    public $alreadyJoined;
    public $showJoinModal;
    public $maxTicketsAvailable;

    public function mount()
    {
        $this->raffle = Raffle::findOrFail($this->id);

        $this->lastUserJoined = RaffleTicket::where('raffle_id', $this->id)
            ->latest()
            ->with('user')
            ->first()
            ?->user;

            $this->alreadyJoined = RaffleTicket::where('raffle_id', $this->id)
        ->where('user_id', auth()->id())
        ->exists();
    }

    public function openJoinModal()
    {

     $user = auth()->user();

     if ($this->raffle->status !== 'active') 
     {
        alert_error('The raffle is not active.');
        return;
     }
     $alreadyJoined = RaffleTicket::where('raffle_id', $this->raffle->id)
                            ->where('user_id', $user->id)
                            ->exists();

     if ($alreadyJoined)
     {
        alert_error('You have already joined this raffle.');
        return;
     }

     $availableTicketsCount = UserTicket::where('user_id', $user->id)
                            ->where('status', 'available')
                            ->count();

     if ($availableTicketsCount < $this->raffle->entry_cost) {
        alert_error("You must have at least {$this->raffle->entry_cost} tickets to join.");
        return;
     }

     $this->joinTicketsCount = $this->raffle->entry_cost;
     $this->maxTicketsAvailable = min($availableTicketsCount, $this->raffle->max_entries_per_user);

     $this->resetErrorBag();
     $this->showJoinModal = true; 
    }

    public function closeJoinModal()
{
    $this->showJoinModal = false;
}

public function confirmJoinRaffle()
{
    try {
        $this->joinRaffle();
        alert_success('Successfully joined the raffle!');
        $this->showJoinModal = false;
    } catch (\Exception $e) {
        alert_error($e->getMessage());
    }

}

public function joinRaffle()
{
    DB::transaction(function () {
        $user = auth()->user();

        if ($this->raffle->status !== 'active') {
            throw new \Exception('The raffle is not active.');
        }

        $alreadyJoined = RaffleTicket::where('raffle_id', $this->raffle->id)
                            ->where('user_id', $user->id)
                            ->exists();

        if ($alreadyJoined) {
            throw new \Exception('You have already joined this raffle.');
        }

        if ($this->joinTicketsCount < $this->raffle->entry_cost ||
            $this->joinTicketsCount > $this->raffle->max_entries_per_user) {
            throw new \Exception('Invalid number of tickets selected.');
        }

        $availableTickets = UserTicket::where('user_id', $user->id)
                            ->where('status', 'available')
                            ->limit($this->joinTicketsCount)
                            ->lockForUpdate()
                            ->get();

        if ($availableTickets->count() < $this->joinTicketsCount) {
            throw new \Exception('You do not have enough available tickets.');
        }

        foreach ($availableTickets as $ticket) {
            RaffleTicket::create([
                'user_id' => $user->id,
                'raffle_id' => $this->raffle->id,
                'user_ticket_id' => $ticket->id,
                'ticket_number' => $ticket->ticket_number,
            ]);

            $ticket->update(['status' => 'assigned']);
            $user->update(['ticket_balance' => $user->ticket_balance - $this->joinTicketsCount]);
        }
    });
}



    public function render()
    {
        return view('livewire.pages.raffle-detail')
            ->layout('components.layouts.app');
    }
}

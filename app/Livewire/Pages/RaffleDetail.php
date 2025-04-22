<?php

namespace App\Livewire\Pages;

use App\Models\Raffle;
use App\Models\RaffleTicket;
use Livewire\Component;

class RaffleDetail extends Component
{
    public $id;
    public $raffle;
    public $lastUserJoined;
    public $joinTicketsCount = 1;
    public $alreadyJoined;
    public $showJoinModal;

    public function mount()
    {
        $this->raffle = Raffle::findOrFail($this->id);

        $this->lastUserJoined = RaffleTicket::where('raffle_id', $this->id)
            ->latest()
            ->with('user')
            ->first()
            ?->user;
    }

    public function openJoinModal()
    {
    if ($this->raffle->status !== 'active') {
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

    $thisjoinTicketsCount = $this->raffle->entry_cost;
    $this->maxTicketsAvailable = min($availableTicketsCount, $this->raffle->max_entries_per_user);

    $this->resetErrorBag();
    $this->dispatchBrowserEvent('open-join-modal');
    }

    public function joinRaffle()
{
    DB::transaction(function () {
        $user = auth()->user();

        if ($this->raffle->status !== 'active') {
            alert_error('The raffle is not active.');
            return;
        }

        $alreadyJoined = RaffleTicket::where('raffle_id', $this->raffle->id)
                            ->where('user_id', $user->id)
                            ->exists();

        if ($alreadyJoined) {
            alert_error('You have already joined this raffle.');
            return;
        }

        if ($this->joinTicketsCount < $this->raffle->entry_cost ||
            $this->joinTicketsCount > $this->raffle->max_entries_per_user) {
            alert_error('Invalid number of tickets selected.');
            return;
        }

        $availableTickets = UserTicket::where('user_id', $user->id)
                            ->where('status', 'available')
                            ->limit($this->joinTicketsCount)
                            ->lockForUpdate()
                            ->get();

        if ($availableTickets->count() < $this->joinTicketsCount) {
            alert_error('You do not have enough available tickets.');
            return;
        }

        foreach ($availableTickets as $ticket) {
            RaffleTicket::create([
                'user_id' => $user->id,
                'raffle_id' => $this->raffle->id,
                'user_ticket_id' => $ticket->id,
                'ticket_number' => $ticket->ticket_number,
            ]);

            $ticket->update(['status' => 'assigned']);
        }
    });

    $this->dispatchBrowserEvent('close-join-modal');
    alert_success('Successfully joined the raffle!');
}


    public function render()
    {
        return view('livewire.pages.raffle-detail')
            ->layout('components.layouts.app');
    }
}

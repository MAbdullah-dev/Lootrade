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

    public function mount()
    {
        $this->raffle = Raffle::findOrFail($this->id);

        $this->lastUserJoined = RaffleTicket::where('raffle_id', $this->id)
            ->latest()
            ->with('user')
            ->first()
            ?->user;
    }

    public function render()
    {
        return view('livewire.pages.raffle-detail')
            ->layout('components.layouts.app');
    }
}

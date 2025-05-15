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
    public $usersJoined;
    public $uniqueUsersCount;

    public function mount()
    {
        $this->raffle = Raffle::findOrFail($this->id);
        $this->raffle->prize = json_decode($this->raffle->prize, true);
        $usersJoined = RaffleTicket::where('raffle_id', $this->id)
        ->select('user_id')
        ->distinct()
        ->with('user')
        ->get();

        $uniqueUsersCount = $usersJoined->count();

        $this->lastUserJoined = RaffleTicket::where('raffle_id', $this->id)
            ->latest()
            ->with('user')
            ->first()
            ?->user;

        $this->alreadyJoined = RaffleTicket::where('raffle_id', $this->id)
        ->where('user_id', auth()->id())
        ->exists();
    }

    public function startGame($mode)
    {
     if ($this->raffle->status !== 'active') {
         return alert_error('This raffle is not active yet. Please check back later.');
     }
 
     if ($mode === 'solo') {
         return redirect()->route('game.solo', ['raffle' => $this->raffle->id]);
     }
 
     if ($mode === 'battle') {
         return redirect()->route('game.battle', ['raffle' => $this->raffle->id]);
     }
 
     return alert_error('Invalid game mode selected.');
    }


    public function render()
    {
        return view('livewire.pages.raffle-detail')
            ->layout('components.layouts.app');
    }
}

<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Raffle;
use Carbon\Carbon;

class Raffles extends Component
{
    public $activeRaffles;
    public $upcomingRaffles;
    public $pastRaffles;

    public function mount()
    {
        $today = Carbon::today();

        $this->activeRaffles = Raffle::where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->latest()
            ->get();

        $this->upcomingRaffles = Raffle::where('start_date', '>', $today)
            ->latest()
            ->get();

        $this->pastRaffles = Raffle::where('end_date', '<', $today)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.pages.raffles');
    }
}

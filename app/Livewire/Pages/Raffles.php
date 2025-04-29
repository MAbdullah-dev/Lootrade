<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Raffle;
use Livewire\WithPagination;

class Raffles extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.pages.raffles', [
            'activeRaffles' => Raffle::where('status', 'active')
                ->latest()
                ->paginate(6),
            'upcomingRaffles' => Raffle::where('status', 'upcoming')
                ->latest()
                ->paginate(6),
            'pastRaffles' => Raffle::where('status', 'past')
                ->latest()
                ->paginate(6),
        ]);
    }
}

<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Raffle;
use App\Models\RaffleTicket;

class AdminRaffleUsers extends Component
{
    use WithPagination;

    public $raffleId;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function mount($raffleId)
    {
        $this->raffleId = $raffleId;
    }

    public function render()
    {
        $entries = RaffleTicket::where('raffle_id', $this->raffleId)
            ->whereHas('user', function($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->with('user')
            ->paginate(10);

        $raffle = Raffle::findOrFail($this->raffleId);

        return view('livewire.admindashboard.admin-raffle-users', compact('entries', 'raffle'))
            ->layout('components.layouts.Admindashboard');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

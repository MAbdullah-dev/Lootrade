<?php

namespace App\Livewire\Dashboard;

use App\Models\RaffleTicket;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserRaffles extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Computed property: use it as $this->raffles in the view
    public function getRafflesProperty()
    {
        return \App\Models\Raffle::whereHas('tickets', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->where('title', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.dashboard.user-raffles', [
            'raffles' => $this->raffles, // This calls getRafflesProperty()
        ])->layout('components.layouts.dashboard');
    }
}

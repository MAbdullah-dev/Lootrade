<?php

namespace App\Livewire\Dashboard;

use App\Models\UserTicket;
use Livewire\Component;
use Livewire\WithPagination;

class MyTickets extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    protected $paginationTheme = 'bootstrap'; // if you're using Bootstrap pagination


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        $tickets = UserTicket::where('user_id', auth()->id())
            ->when($this->search, function ($query) {
                $query->where('ticket_number', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(5);


        return view('livewire.dashboard.my-tickets', [
            'tickets' => $tickets,
        ])->layout('components.layouts.dashboard');
    }
}

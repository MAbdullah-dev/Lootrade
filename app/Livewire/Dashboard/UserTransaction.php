<?php

namespace App\Livewire\Dashboard;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class UserTransaction extends Component
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
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $transactions = Transaction::with('ticketPackage')
            ->where('user_id', auth()->id()) // Get transactions only for the logged-in user
            ->where(function ($query) {
                $query->whereHas('ticketPackage', fn($q) => $q->where('type', 'like', '%' . $this->search . '%'))
                    ->orWhere('stripe_transaction_id', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(3);

        return view('livewire.dashboard.user-transaction', compact('transactions'))
            ->layout('components.layouts.dashboard'); // Assuming a dashboard layout
    }
}

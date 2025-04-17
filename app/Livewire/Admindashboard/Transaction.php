<?php

namespace App\Livewire\Admindashboard;

use App\Models\Transaction as ModelsTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class Transaction extends Component
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
        $transactions = ModelsTransaction::with('user', 'ticketPackage')
            ->where(function ($query) {
                $query->whereHas('user', fn($q) => $q->where('username', 'like', '%' . $this->search . '%'))
                    ->orWhereHas('ticketPackage', fn($q) => $q->where('type', 'like', '%' . $this->search . '%'))
                    ->orWhere('stripe_transaction_id', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(3);

        return view('livewire.admindashboard.transaction', compact('transactions'))
            ->layout('components.layouts.Admindashboard');
    }
}

<?php

namespace App\Livewire\Admindashboard;

use App\Models\Transaction as ModelsTransaction;
use Livewire\Component;

class Transaction extends Component
{
    public $transactions;

    public function mount()
    {
        $this->loadtransactions();
    }

    public function loadtransactions()
    {
        $this->transactions = ModelsTransaction::with('user', 'ticketPackage')->get();
        // dd($this->transactions);
    }
    public function render()
    {

        return view('livewire.admindashboard.transaction')->layout('components.layouts.Admindashboard');
    }
}

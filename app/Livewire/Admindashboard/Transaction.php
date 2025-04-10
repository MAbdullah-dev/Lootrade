<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;

class Transaction extends Component
{
    public function render()
    {
        return view('livewire.admindashboard.transaction')->layout('components.layouts.Admindashboard');
    }
}

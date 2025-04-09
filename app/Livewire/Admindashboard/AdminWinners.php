<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;

class AdminWinners extends Component
{
    public function render()
    {
        return view('livewire.admindashboard.admin-winners')->layout('components.layouts.Admindashboard');
    }
}

<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;

class AdminRaffles extends Component
{
    public function render()
    {
        return view('livewire.admindashboard.admin-raffles')->layout('components.layouts.Admindashboard');
    }
}

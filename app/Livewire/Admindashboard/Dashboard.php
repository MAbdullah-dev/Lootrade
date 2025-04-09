<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admindashboard.dashboard')->layout('components.layouts.Admindashboard');
    }
}

<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class MyTickets extends Component
{
    public function render()
    {
        return view('livewire.dashboard.my-tickets')->layout('components.layouts.dashboard');
    }
}

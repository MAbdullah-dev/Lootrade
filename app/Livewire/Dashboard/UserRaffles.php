<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class UserRaffles extends Component
{
    public function render()
    {
        return view('livewire.dashboard.user-raffles')->layout('components.layouts.dashboard');
    }
}

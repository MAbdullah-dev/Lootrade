<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        return view('livewire.admindashboard.users')->layout('components.layouts.Admindashboard');
    }
}

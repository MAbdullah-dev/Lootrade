<?php

namespace App\Livewire\Admindashboard;

use Livewire\Component;

class TicketPackeges extends Component
{
    public function render()
    {
        return view('livewire.admindashboard.ticket-packeges')->layout('components.layouts.Admindashboard');
    }
}

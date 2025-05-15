<?php

namespace App\Livewire\Inc;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Header extends Component
{

    public $ticketCount;
    public $isNotAdmin = true;

    public function mount()
    {
        $this->ticketCount = Auth::user()->ticket_balance;
        $this->isNotAdmin = Auth::user()->role_id == 1 ? true : false;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.inc.header');
    }
}

<?php

namespace App\Livewire\Inc;

use Livewire\Component;

class Admindashboardsidebar extends Component
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.inc.admindashboardsidebar');
    }
}

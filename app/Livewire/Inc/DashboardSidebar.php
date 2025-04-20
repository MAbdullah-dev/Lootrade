<?php

namespace App\Livewire\Inc;

use Livewire\Component;

class DashboardSidebar extends Component
{

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.inc.dashboard-sidebar');
    }
}

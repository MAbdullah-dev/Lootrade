<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    public function redirectToLogin(){ 
         return redirect('/login');
    }

    public function redirectToGoogleLogin(){ 
         return redirect('auth/google', 'google');
    }
    public function redirectToDiscordLogin()
    {
        return redirect('auth/discord', 'discord');
    }

    public function redirectToTwitterLogin()
    {
        return redirect('auth/twitter', 'twitter');
    }

    public function render()
    {
        return view('livewire.welcome')->layout('components.layouts.main');
    }
}

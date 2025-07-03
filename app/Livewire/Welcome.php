<?php

namespace App\Livewire;

use App\Models\NewsletterSubscriber;
use Livewire\Component;

class Welcome extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email|unique:newsletter_subscribers,email',
    ];

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
    public function redirectToTwitchLogin()
    {
        return redirect('auth/twitch', 'twitch');
    }
    public function redirectToKickLogin()
    {
        return redirect('auth/kick', 'kick');
    }
    public function subscribe()
    {
        $this->validate();

        NewsletterSubscriber::create([
            'email' => $this->email
        ]);

        session()->flash('message', 'You have successfully subscribed to the newsletter!');

        $this->email = ''; // Reset email field
    }


    public function render()
    {
        return view('livewire.welcome')->layout('components.layouts.main');
    }
}

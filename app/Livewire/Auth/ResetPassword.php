<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPassword extends Component
{
    public $password;
    public $password_confirmation;
    public $token;
    public $email;

    protected $rules = [
        'password' => 'required|min:8|confirmed',
    ];

    public function mount($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            alert_success('Your password has been successfully reset!');
            return redirect()->route('login');
        } else {
            alert_error('There was an error resetting your password. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password')->layout('components.layouts.main');
    }
}

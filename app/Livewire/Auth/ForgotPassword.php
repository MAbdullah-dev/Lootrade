<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = '';
    public $successMessage = '';

    public function sendResetLink()
    {
        $this->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $status = Password::sendResetLink([
            'email' => $this->email,
        ]);

        if ($status === Password::RESET_LINK_SENT) {
            // Follow your project style
            alert_success('Password reset link sent successfully!');
            $this->dispatch('close-modal');
            $this->resetForm();
            // No need for loaduserdata() here, but if needed, you can call a refresh function
        } else {
            alert_error('Failed to send reset link. Please try again.');
        }
    }

    public function resetForm()
    {
        $this->reset('email', 'successMessage');
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}

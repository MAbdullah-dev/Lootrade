<?php

namespace App\Livewire\Dashboard;

use App\Rules\RegisterPasswordRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChangePassword extends Component
{
    #[Validate('required|string|min:8')]
    public $current_password;

    #[Validate([
        'required',
        'string',
        new RegisterPasswordRule, // << Your custom rule!
        'different:current_password',
    ])]
    public $new_password;

    #[Validate('required|string|same:new_password')]
    public $confirm_password;

    public function changePassword()
    {
        $this->validate();

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        alert_success('Password updated successfully.');

        $this->reset(['current_password', 'new_password', 'confirm_password']);
    }

    public function render()
    {
        return view('livewire.dashboard.change-password')->layout('components.layouts.dashboard');
    }
}

<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Rules\RegisterPasswordRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Login extends Component
{

    public $login_email = '';
    public $login_password = '';

    public $register_first_name = '';
    public $register_last_name = '';
    public $register_username = '';
    public $register_email = '';
    public $register_password = '';
    public $register_password_confirmation = '';
    public $register_date_of_birth = '';

    public $activeTab = 'login';

    protected function rules()
    {
        if ($this->activeTab === 'login') {
            return [
                'login_email' => 'required|email',
                'login_password' => 'required',
            ];
        }

        return [
            'register_first_name' => 'required|string|max:255',
            'register_last_name' => 'required|string|max:255',
            'register_username' => 'required|string|max:255|unique:users,username',
            'register_email' => 'required|email|max:255|unique:users,email',
            'register_password' => ['required', 'confirmed', new RegisterPasswordRule()],
            'register_date_of_birth' => 'required|date|before:today',
        ];
    }

    protected function messages()
    {
        return [
            'register_date_of_birth.required' => 'Please enter your birth date.',
            'register_date_of_birth.date' => 'Please enter a valid date in YYYY-MM-DD format.',
            'register_date_of_birth.before' => 'Your birth date must be before today.',
            'register_first_name.required' => 'Please enter your first name.',
            'register_last_name.required' => 'Please enter your last name.',
            'register_username.required' => 'Please choose a username.',
            'register_username.unique' => 'This username is already taken.',
            'register_email.required' => 'Please enter your email address.',
            'register_email.email' => 'Please enter a valid email address.',
            'register_email.unique' => 'This email is already registered.',
            'register_password.confirmed' => 'Passwords do not match.',
            'login_email.required' => 'Please enter your email address.',
            'login_email.email' => 'Please enter a valid email address.',
            'login_password.required' => 'Please enter your password.',
        ];
    }

    public function updatedActiveTab($value)
    {
        $this->activeTab = $value;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->activeTab = 'login';
        $this->validate();

        if (Auth::attempt(['email' => $this->login_email, 'password' => $this->login_password])) {
            alert_success('Login successful!');
            if (Auth::user()->role_id == 1) {
                return redirect('/home');
            } elseif (Auth::user()->role_id == 2) {
                return redirect('/admin/dashboard');
            }
        } else {
            alert_error('Login failed!');
        }
    }

    public function register()
    {
        $this->activeTab = 'register';
        $this->validate();

        $user = User::create([
            'first_name' => $this->register_first_name,
            'last_name' => $this->register_last_name,
            'username' => $this->register_username,
            'email' => $this->register_email,
            'password' => Hash::make($this->register_password),
            'date_of_birth' => $this->register_date_of_birth,
            'joined_date' => now(),
            'role_id' => 1,
            'ticket_balance' => 0,
            'profile_completion_awarded' => false,
            'last_login_award_date' => null,
        ]);

        $user->notifications()->create([
            'type' => 'registration',
            'message' => 'Welcome to the raffle system, ' . $user->first_name . '!',
        ]);

        Auth::login($user);

        alert_success('Registered successfully!');

        return redirect('/home');
    }

    public function redirectToGoogleLogin()
    {
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
        return view('livewire.auth.login')->layout('components.layouts.main');
    }
}

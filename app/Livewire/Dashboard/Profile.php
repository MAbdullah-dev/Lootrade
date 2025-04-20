<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserSocialAccount;
use App\Services\TicketGenerationService;


class Profile extends Component
{

    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $username;
    public $date_of_birth;
    public $profile_picture;
    public $existing_profile_picture;

    public $connected_providers = [];

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,   username',
        'date_of_birth' => 'nullable|date|before:today',
        'profile_picture' => 'nullable|image|max:5120',
    ];

    public function mount()
    {
        $user = Auth::user();


        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->date_of_birth = $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : null;
        $this->existing_profile_picture = $user->profile_picture;


        $this->connected_providers = UserSocialAccount::where('user_id', $user->id)
            ->pluck('provider')
            ->toArray();
    }

    public function updatedUsername()
    {

        $this->rules['username'] = 'required|string|max:255|unique:users,username,' . Auth::id();
    }

    public function save()
{
    $this->rules['username'] = 'required|string|max:255|unique:users,username,' . Auth::id();
    $this->validate();

    $user = Auth::user();

    if ($this->profile_picture) {
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        $path = $this->profile_picture->store('profile‑pictures', 'public');
        $user->profile_picture = $path;
    }

    $user->update([
        'first_name' => $this->first_name,
        'last_name'  => $this->last_name,
        'username'   => $this->username,
        'date_of_birth' => $this->date_of_birth,
    ]);

    if (! $user->profile_completion_awarded
        && $user->first_name
        && $user->last_name
        && $user->username
        && $user->date_of_birth
        && $user->profile_picture
    ) {

        app(TicketGenerationService::class)
            ->generateTickets($user->id, 10, 'earned');

        $user->update([
            'profile_completion_awarded' => true,
            'ticket_balance'             => $user->ticket_balance + 10,
        ]);

        alert_success('🎉 You’ve earned 10 tickets for completing your profile!');
    }
    else{
        alert_success('Profile updated successfully!');
    }
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
        return view('livewire.dashboard.profile', ['connected_providers' => $this->connected_providers])->layout('components.layouts.dashboard');
    }
}

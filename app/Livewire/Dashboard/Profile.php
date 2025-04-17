<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserSocialAccount;

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
        'username' => 'required|string|max:255|unique:users,username',
        'date_of_birth' => 'nullable|date|before:today',
        'profile_picture' => 'nullable|image|max:2048',
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
        $this->validate();

        $user = Auth::user();


        if ($this->profile_picture) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $this->profile_picture->store('profile-pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'username' => $this->username,
            'date_of_birth' => $this->date_of_birth,
        ]);

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.dashboard.profile', ['connected_providers' => $this->connected_providers])->layout('components.layouts.dashboard');
    }
}

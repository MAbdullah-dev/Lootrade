<?php

namespace App\Livewire\Dashboard;

use App\Jobs\GenerateTicketsJob;
use App\Models\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    public $notifications, $unreadCount;

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

            $this->loadnotifications();
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

            GenerateTicketsJob::dispatch($user->id, 10, 'earned');

            $user->notifications()->create([
                'type' => 'profile_completion_awarded',
                'message' => "You have been awarded 10 tickets for completing your profile.", 
            ]);

        $user->update([
            'profile_completion_awarded' => true,
            'ticket_balance'             => $user->ticket_balance + 10,
        ]);

        alert_success('🎉 You’ve earned 10 tickets for completing your profile!');
    }
    else{
        alert_success('Profile updated successfully!');
    }

    $this->loadnotifications();

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

    public function loadnotifications()
    {
        $user = Auth::user();
        $this->notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->where('is_read', false)
            ->limit(10)
            ->get();
        $this->unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
    }

    public function deleteNotification($notificationId)
    {
        $notification = Notification::find($notificationId);

        if ($notification && $notification->user_id === auth()->id()) {
            $notification->update(['is_read' => true]);
        }

         $this->loadnotifications();
    }


    public function render()
    {
        return view('livewire.dashboard.profile', ['connected_providers' => $this->connected_providers, 'notifications' => $this->notifications,] )->layout('components.layouts.dashboard');
    }
}

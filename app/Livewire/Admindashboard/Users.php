<?php

namespace App\Livewire\Admindashboard;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;
    public $selectedUser = null;

    public function mount()
    {
        $this->loaduserdata();
    }

    public function loaduserdata()
    {
        $this->users = User::withTrashed()->with('role')->get();
    }
    public function blockUser($id)
    {
        $user = User::find($id);
        $user?->delete();
        $this->loaduserdata(); // Refresh the user list
    }

    public function unblockUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user?->restore();
        $this->loaduserdata(); // Refresh the user list
    }
    public function viewUser($id)
    {
        $user = User::withTrashed()->with('role')->find($id);
        if ($user) {
            $this->selectedUser = $user->toArray();
        }
    }
    public function resetSelectedUser()
    {
        $this->selectedUser = null;
    }
    public function render()
    {
        return view('livewire.admindashboard.users')->layout('components.layouts.Admindashboard');
    }
}

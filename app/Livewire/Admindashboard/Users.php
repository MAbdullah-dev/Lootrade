<?php

namespace App\Livewire\Admindashboard;

use App\Jobs\GenerateTicketsJob;
use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public $users;
    public $selectedUser = null;
    public $ticketCount, $ticketUserId;

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
    if ($user) {
        
        adminLog('Blocked user', [
            'target_user_id' => $user->id,
            'target_user_name' => $user->first_name . ' ' . $user->last_name,
        ]);
        $user->delete();
    }

    $this->loaduserdata();
}


    public function unblockUser($id)
    {
        $user = User::withTrashed()->find($id);
        $user?->restore();
        $this->loaduserdata(); 
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
    public function prepareToGiveTickets($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $this->ticketUserId = $user->id;
            $this->selectedUser = $user->toArray(); 
            $this->ticketCount = '';
        }
    }

    public function giveTickets()
    {
        $this->validate([
            'ticketCount' => 'required|integer|min:1',
        ]);

        $user = User::withTrashed()->find($this->ticketUserId);  

        if ($user) {
            GenerateTicketsJob::dispatch($user->id, $this->ticketCount, 'earned');

            $user->update([
                'ticket_balance' => $user->ticket_balance + $this->ticketCount,
            ]);

            $this->dispatch('close-modal');
            alert_success('Tickets successfully given!');
            $this->resetForm();  

            $this->loaduserdata();
        }
    }

    public function resetForm()
    {
        $this->ticketCount = null;
        $this->ticketUserId = null;
        $this->selectedUser = null;
    }
    public function render()
    {
        return view('livewire.admindashboard.users')->layout('components.layouts.Admindashboard');
    }
}

<?php

namespace App\Livewire\Admindashboard;

use App\Jobs\GenerateTicketsJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Users extends Component
{
    public $users;
    public $selectedUser = null;
    public $ticketCount, $ticketUserId;
    public $isSuperAdmin = false;

    public function mount()
    {
        $this->loaduserdata();
        $this->isSuperAdmin = Auth::user()->role_id == 3;
    }

    public function loaduserdata()
    {
        if(Auth::user()->role_id == 2) {
        $this->users = User::withTrashed()->with('role')->where('role_id', 1)->get();
        }elseif(Auth::user()->role_id == 3) {
        $this->users = User::withTrashed()->with('role')->whereIn('role_id', [1,2])->get();
    }
}
    public function blockUser($id)
{
    $user = User::find($id);
    if ($user) {

        adminLog('Admin blocked a user account.', [
            'action' => 'block_user',
            'target_user_id' => $user->id,
            'target_user_name' => $user->first_name . ' ' . $user->last_name,
            'target_user_email' => $user->email,
            'performed_by_admin_id' => auth()->id(),
            'performed_by_admin_email' => auth()->user()->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
        $user->delete();
    }

    $this->loaduserdata();
}


    public function unblockUser($id)
{
    $user = User::withTrashed()->find($id);

    if ($user?->restore()) {
        adminLog("Admin unblocked a user account.", [
            'action' => 'unblock_user',
            'target_user_id' => $user->id,
            'target_user_name' => $user->name,
            'target_user_email' => $user->email,
            'performed_by_admin_id' => auth()->id(),
            'performed_by_admin_email' => auth()->user()->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

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

            adminLog('Admin gave tickets to user.', [
            'action' => 'give_tickets',
            'ticket_count' => $this->ticketCount,
            'target_user_id' => $user->id,
            'target_user_name' => $user->first_name . ' ' . $user->last_name,
            'target_user_email' => $user->email,
            'new_ticket_balance' => $user->ticket_balance,
            'performed_by_admin_id' => auth()->id(),
            'performed_by_admin_email' => auth()->user()->email,
            'timestamp' => now()->toDateTimeString(),
        ]);

            $this->dispatch('close-modal');
            alert_success('Tickets successfully given!');
            $this->resetForm();

            $this->loaduserdata();
        }
    }
    public function promoteToAdmin($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->update(['role_id' => 2]);
            alert_success($user->first_name . ' promoted to admin successfully!');
            $this->loaduserdata();
        }
    }

    public function reassignToUser($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->update(['role_id' => 1]);
            alert_success($user->first_name . ' reassigned to user role successfully!');
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

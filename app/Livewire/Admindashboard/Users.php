<?php

namespace App\Livewire\Admindashboard;

use App\Jobs\GenerateTicketsJob;
use App\Models\User;
use Livewire\Component;

use function Laravel\Prompts\alert;

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
    public function prepareToGiveTickets($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $this->ticketUserId = $user->id;
            $this->selectedUser = $user->toArray(); // Optional: you can show this in the modal title
            $this->ticketCount = ''; // Reset ticket count
        }
    }

    public function giveTickets()
    {
        $this->validate([
            'ticketCount' => 'required|integer|min:1', // Validate the ticket count
        ]);

        $user = User::withTrashed()->find($this->ticketUserId);  // Find the user

        if ($user) {
            // Generate the tickets using the service
            // app('App\Services\TicketGenerationService')->generateTickets($user->id, $this->ticketCount, 'earned');
            GenerateTicketsJob::dispatch($user->id, $this->ticketCount, 'earned');


            // Update user's ticket balance
            $user->update([
                'ticket_balance' => $user->ticket_balance + $this->ticketCount,
            ]);

            // Emit the event to close the modal and refresh the user list
            $this->dispatch('close-modal');
            alert_success('Tickets successfully given!');
            $this->resetForm();  // Reset the form values

            // Reload the user data
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

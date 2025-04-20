<?php

namespace App\Livewire\Dashboard;

use App\Models\SupportTicket;
use Livewire\Component;
use Livewire\WithPagination;

class Support extends Component
{
    use WithPagination;

    public $subject = '';
    public $description = '';
    public $search = '';

    protected $rules = [
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function submit()
    {
        $this->validate();

        SupportTicket::create([
            'user_id' => auth()->id(),
            'subject' => $this->subject,
            'description' => $this->description,
            'status' => 'open',
        ]);

        $this->reset(['subject', 'description']);

        alert_success('Your support ticket has been submitted successfully!');
    }

    public function render()
    {
        $tickets = SupportTicket::where('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('subject', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(5);

        return view('livewire.dashboard.support', [
            'tickets' => $tickets,
        ])->layout('components.layouts.dashboard');
    }
}

<?php

namespace App\Livewire\Admindashboard;

use App\Models\Raffle;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminRaffles extends Component
{
    use WithPagination, WithFileUploads;

    public $title, $description, $entry_cost, $max_entries_per_user, $prize, $date_range, $start_date, $end_date, $image, $slots;
    public $search = '';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';

    public function createRaffle()
    {
        $this->validate([
            'title' => 'required|string|max:20',
            'description' => 'nullable|string|min:100|max:1000',
            'entry_cost' => 'required|integer|min:1',
            'max_entries_per_user' => 'required|integer|min:1|gte:entry_cost',
            'date_range' => 'required|string',
            'prize' => 'required|integer|min:1',
            'slots' => 'required|integer|min:1',
            'image' => 'required|image|max:2048',
        ]);

        $dates = explode(' to ', $this->date_range);
        $start_date = trim($dates[0] ?? '');
        $end_date = trim($dates[1] ?? '');

        if (!$start_date || !$end_date) {
            $this->addError('date_range', 'Please select a valid start and end date.');
            return;
        }

        if (now()->gt($start_date)) {
            $this->addError('date_range', 'Start date must be in the future.');
            return;
        }

        if (now()->diffInDays($start_date) > 14 || now()->diffInDays($end_date) > 14) {
            $this->addError('date_range', 'Raffle duration cannot be more than 2 weeks.');
            return;
        }

        $path = $this->image->store('raffles', 'public');

        Raffle::create([
            'title' => $this->title,
            'description' => $this->description,
            'entry_cost' => $this->entry_cost,
            'max_entries_per_user' => $this->max_entries_per_user,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'prize' => $this->prize,
            'slots' => $this->slots,
            'image_path' => $path,
        ]);

        $this->reset();
        $this->dispatch('raffleCreated');
        alert_success('Raffle created successfully!');
    }

    public function viewRaffle($raffleId)
    {
        return redirect()->route('admin.raffle.users', $raffleId);
    }


    public function render()
    {
        $raffles = Raffle::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', $this->sortDirection)
            ->paginate(10);

        return view('livewire.admindashboard.admin-raffles', compact('raffles'))
            ->layout('components.layouts.Admindashboard');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

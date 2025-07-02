<?php

namespace App\Livewire\Admindashboard;

use App\Jobs\CreateNotificationsJob;
use App\Jobs\SendGlobalNotificationJob;
use App\Models\Raffle;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminRaffles extends Component
{
    use WithPagination, WithFileUploads;

    public $title, $raffle_id, $description, $entry_cost, $max_entries_per_user, $prize, $date_range, $start_date, $end_date, $image, $slots, $video;
    public $search = '';
    public $sortDirection = 'desc';
    public $message;

    protected $paginationTheme = 'bootstrap';

    public function resetForm()
    {
     $this->title = '';
     $this->description = '';
     $this->entry_cost = null;
     $this->max_entries_per_user = null;
     $this->date_range = '';
     $this->slots = null;
     $this->prize = null;
     $this->image = null;
    }

    public $prizes = [
    ['name' => '', 'description' => '', 'value' => '', 'quantity' => 1]
    ];

    public function addPrize()
    {
        $this->prizes[] = ['name' => '', 'description' => '', 'value' => '', 'quantity' => 1];
    }

    public function createRaffle()
    {
        $this->validate([
            'title' => 'required|string|max:20',
            'description' => 'nullable|string|min:100|max:1000',
            'entry_cost' => 'required|integer|min:1',
            'max_entries_per_user' => 'required|integer|min:1|gte:entry_cost',
            'date_range' => 'required|string',
            'prizes' => 'required|array',
            'prizes.*.name' => 'required|string',
            'prizes.*.description' => 'nullable|string',
            'prizes.*.value' => 'required|numeric|min:1',
            'prizes.*.quantity' => 'required|integer|min:1',
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

        $prize_info = json_encode($this->prizes);

        $raffle = Raffle::create([
            'title' => $this->title,
            'description' => $this->description,
            'entry_cost' => $this->entry_cost,
            'max_entries_per_user' => $this->max_entries_per_user,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'prize_info' => $prize_info,
            'slots' => $this->slots,
            'image_path' => $path,
        ]);

        adminLog('Admin created a new raffle.', [
        'action' => 'create_raffle',
        'raffle_id' => $raffle->id,
        'title' => $raffle->title,
        'start_date' => $raffle->start_date,
        'end_date' => $raffle->end_date,
        'entry_cost' => $raffle->entry_cost,
        'slots' => $raffle->slots,
        'prizes' => $this->prizes,
        'performed_by_admin_id' => auth()->id(),
        'performed_by_admin_email' => auth()->user()->email,
        'timestamp' => now()->toDateTimeString(),
    ]);

        $message = "Raffle '{$this->title}' has been created with prizes: " . json_encode($this->prizes);
        CreateNotificationsJob::dispatch('global', $message);
        //  for dev: use aftercommit() to send notification if inside a transaction after dispatching the job;

        $this->reset();
        $this->dispatch('raffleCreated');
        alert_success('Raffle created successfully!');
    }

    public function viewRaffle($raffleId)
    {
        return redirect()->route('admin.raffle.users', $raffleId);
    }

    public function viewForEditRaffle($raffleId)
    {
        $raffle = Raffle::find($raffleId);

        if (!$raffle) {
            alert_error('Raffle not found.');
            return;
        }

        $this->raffle_id = $raffle->id;
        $this->title = $raffle->title;
        $this->description = $raffle->description;
        $this->entry_cost = $raffle->entry_cost;
        $this->max_entries_per_user = $raffle->max_entries_per_user;
        $this->prize = $raffle->prize;
        $this->slots = $raffle->slots;
        $this->date_range = $raffle->start_date->format('Y-m-d H:i') . ' to ' . $raffle->end_date->format('Y-m-d H:i');
        $this->image = null;

        $this->dispatch('showEditModal');

    }

    public function updateRaffle()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'entry_cost' => 'required|integer|min:1',
            'max_entries_per_user' => 'required|integer|min:1',
            'date_range' => 'required|string',
            'slots' => 'required|integer|min:1',
            'prize' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        $raffle = Raffle::find($this->raffle_id);

        if (!$raffle) {
            alert_error('Raffle not found.');
            return;
        }

        [$startDate, $endDate] = explode(' to ', $this->date_range);

        $original = $raffle->toArray();

        $raffle->update([
            'title' => $this->title,
            'description' => $this->description,
            'entry_cost' => $this->entry_cost,
            'max_entries_per_user' => $this->max_entries_per_user,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'slots' => $this->slots,
            'prize' => $this->prize,
        ]);

        if ($this->image) {
            $path = $this->image->store('raffle-images', 'public');
            $raffle->update(['image' => $path]);
        }

        adminLog('Admin updated a raffle.', [
        'action' => 'update_raffle',
        'raffle_id' => $raffle->id,
        'original' => $original,
        'updated' => [
            'title' => $this->title,
            'description' => $this->description,
            'entry_cost' => $this->entry_cost,
            'max_entries_per_user' => $this->max_entries_per_user,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'slots' => $this->slots,
            'prize' => $this->prize,
        ],
        'performed_by_admin_id' => auth()->id(),
        'performed_by_admin_email' => auth()->user()->email,
        'timestamp' => now()->toDateTimeString(),
    ]);

        $this->dispatch('hideEditModal');
        alert_success('Raffle updated successfully!');
    }


    public function render()
    {
        $raffles = Raffle::where('title', 'like', '%' . $this->search . '%')
        ->orderByRaw("status = 'Active' DESC")
        ->paginate(10);


        return view('livewire.admindashboard.admin-raffles', compact('raffles'))
            ->layout('components.layouts.Admindashboard');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}

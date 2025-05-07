<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Raffle;

class RaffleForm extends Component
{

    use WithFileUploads;

    public $raffleId;
    public $title;
    public $description;
    public $max_entries_per_user;
    public $start_date;
    public $end_date;
    public $slots;
    public $image;
    public $video;
    public $prizes = [
        ['name' => '', 'description' => '', 'value' => null, 'quantity' => null],
    ];

        protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'max_entries_per_user' => 'required|integer|min:1',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'slots' => 'required|integer|min:1',
        'image' => 'nullable|image|max:2048',
        'video' => 'nullable|mimetypes:video/mp4,video/x-msvideo|max:10240',
        'prizes.*.name' => 'required|string|max:255',
        'prizes.*.description' => 'required|string',
        'prizes.*.value' => 'nullable|numeric',
        'prizes.*.quantity' => 'nullable|integer',
    ];

    protected $listeners = ['setDateRange'];

    public function mount($raffle = null)
    {
        if ($raffle) {
            $this->raffleId = $raffle->id;
            $this->title = $raffle->title;
            $this->description = $raffle->description;
            $this->max_entries_per_user = $raffle->max_entries_per_user;
            $this->start_date = $raffle->start_date;
            $this->end_date = $raffle->end_date;
            $this->slots = $raffle->slots;
            $this->prizes = $raffle->prizes->map(function ($prize) {
                return [
                    'name' => $prize->name,
                    'description' => $prize->description,
                    'value' => $prize->value,
                    'quantity' => $prize->quantity,
                ];
            })->toArray();
        }
    }

    public function setDateRange($range)
    {
        $this->start_date = $range['start'];
        $this->end_date = $range['end'];
        dd($this->start_date, $this->end_date);
    }

    public function save()
    {
        $this->validate();

        $raffle = Raffle::updateOrCreate(
            ['id' => $this->raffleId],
            [
                'title' => $this->title,
                'description' => $this->description,
                'max_entries_per_user' => $this->max_entries_per_user,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'slots' => $this->slots,
            ]
        );

        if ($this->image) {
            $raffle->image_path = $this->image->store('raffle_images', 'public');
        }

        if ($this->video) {
            $raffle->video_path = $this->video->store('raffle_videos', 'public');
        }

        $raffle->save();

        $raffle->prizes()->delete();
        foreach ($this->prizes as $prizeData) {
            $raffle->prizes()->create($prizeData);
        }

        alert_success('success', 'Raffle saved successfully!');
    }



    public function render()
    {
        return view('livewire.pages.raffle-form')->layout('components.layouts.raffleForm');
    }
}

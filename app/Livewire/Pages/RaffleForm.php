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

    public function rules()
    {
        return [

        'title' => 'required|string|min:5|max:255|unique:raffles,title,' . $this->raffleId,
        'description' => 'required|string|min:10',
        'max_entries_per_user' => 'required|integer|min:1|max:1000',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after:start_date',
        'slots' => 'required|integer|min:1|max:10000',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'video' => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/x-msvideo|max:10240',

        'prizes' => 'required|array|min:1',
        'prizes.*.name' => 'required|string|max:255',
        'prizes.*.description' => 'required|string',
        'prizes.*.value' => 'nullable|numeric',
        'prizes.*.quantity' => 'nullable|integer',

    ];
    }



    protected $listeners = ['setDateRange'];

    public function messages()
    {
        return [
            'prizes.0.name.required' => 'The prize name is mandatory.',
            'prizes.0.description.required' => 'Please provide a description for the prize.',
            'prizes.0.value.numeric' => 'The prize value must be a number.',
            'prizes.0.quantity.integer' => 'The prize quantity must be an integer.',
        ];
    }


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
            $this->prizes = is_array($raffle->prize) ? $raffle->prize : [];
        }
    }

    public function setDateRange($start, $end)
    {
        $this->start_date = $start;
        $this->end_date = $end;
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
                'prize' => json_encode($this->prizes)
            ]
        );

        if ($this->image) {
            $raffle->image_path = $this->image->store('raffle_images', 'public');
        }

        if ($this->video) {
            $raffle->video_path = $this->video->store('raffle_videos', 'public');
        }

        $raffle->save();

        alert_success('Raffle saved successfully!');

        $this->reset();

        return redirect('/raffle/' . $raffle->id);
    }



    public function render()
    {
        return view('livewire.pages.raffle-form')->layout('components.layouts.raffleForm');
    }
}

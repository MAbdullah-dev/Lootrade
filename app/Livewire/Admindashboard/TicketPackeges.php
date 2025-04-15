<?php

namespace App\Livewire\Admindashboard;

use App\Models\Package;
use Livewire\Component;

class TicketPackeges extends Component
{
    public $type, $tickets, $price;
    public $packages;
    public function mount()
    {
        $this->loadPackages();
    }
    public function loadPackages()
    {
        $this->packages = Package::latest()->get();
    }
    protected $rules = [
        'type' => 'required|string|max:255',
        'tickets' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ];

    public function store()
    {
        $this->validate();

        Package::create([
            'type' => $this->type,
            'tickets' => $this->tickets,
            'price' => $this->price,
        ]);

        // Clear the form
        $this->reset(['type', 'tickets', 'price']);

        session()->flash('success', 'Package created successfully!');
    }
    public function render()
    {
        return view('livewire.admindashboard.ticket-packeges')->layout('components.layouts.Admindashboard');
    }
}

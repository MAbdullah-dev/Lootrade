<?php

namespace App\Livewire\Admindashboard;

use App\Models\TicketPackege;
use Livewire\Component;

class TicketPackages extends Component
{
    public $type, $tickets, $price, $package_id;
    public $packages;
    public $editType, $editTickets, $editPrice;


    protected $rules = [
        'type' => 'required|string|max:255',
        'tickets' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->loadPackages();
    }

    public function loadPackages()
    {
        $this->packages = TicketPackege::latest()->get();
    }

    public function store()
    {
        $this->validate();

        TicketPackege::create([
            'type' => $this->type,
            'tickets' => $this->tickets,
            'price' => $this->price,
        ]);

        $this->reset(['type', 'tickets', 'price']);
        $this->loadPackages();
        session()->flash('success', 'Package created successfully!');
    }

    public function edit($id)
    {
        $package = TicketPackege::findOrFail($id);
        $this->package_id = $package->id;
        $this->editType = $package->type;
        $this->editTickets = $package->tickets;
        $this->editPrice = $package->price;
    }


    public function update()
    {
        $this->validate([
            'editType' => 'required|string|max:255',
            'editTickets' => 'required|integer|min:1',
            'editPrice' => 'required|numeric|min:0',
        ]);

        $package = TicketPackege::findOrFail($this->package_id);
        $package->update([
            'type' => $this->editType,
            'tickets' => $this->editTickets,
            'price' => $this->editPrice,
        ]);

        $this->resetForm();
        $this->loadPackages();

        session()->flash('success', 'Package updated successfully!');
        $this->dispatch('close-modal');
    }


    public function delete($id)
    {
        $this->package_id = $id;
    }

    public function confirmDelete()
    {
        TicketPackege::destroy($this->package_id);
        $this->resetForm();
        $this->loadPackages();

        session()->flash('success', 'Package deleted successfully!');
        $this->dispatch('close-modal');
    }
    public function resetForm()
    {
        $this->reset([
            'type',
            'tickets',
            'price', // for create form
            'editType',
            'editTickets',
            'editPrice', // for edit modal
            'package_id'
        ]);
    }

    public function render()
    {
        return view('livewire.admindashboard.ticket-packages')->layout('components.layouts.Admindashboard');
    }
}

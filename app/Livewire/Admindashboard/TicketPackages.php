<?php

namespace App\Livewire\Admindashboard;

use App\Models\PackageType;
use App\Models\TicketPackage;
use Livewire\Component;

class TicketPackages extends Component
{
    public $type, $tickets, $price, $package_id;
    public $packages;
    public $editType, $editTickets, $editPrice;
    public $packagesTypes;


    protected $rules = [
        'type' => 'required|string|max:255',
        'tickets' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->loadPackages();
        $this->loadpackagesTypes();
    }

    public function loadPackages()
    {
        $this->packages = TicketPackage::latest()->get();
    }
    public function loadpackagesTypes()
    {
        $this->packagesTypes = PackageType::latest()->get();
    }

    public function store()
    {
        $this->validate();

        $package = TicketPackage::create([
            'type' => $this->type,
            'tickets' => $this->tickets,
            'price' => $this->price,
        ]);

        adminLog('Created a new ticket package.', [
        'action' => 'create_ticket_package',
        'package_id' => $package->id,
        'type' => $package->type,
        'tickets' => $package->tickets,
        'price' => $package->price,
        'performed_by_admin_id' => auth()->id(),
        'performed_by_admin_email' => auth()->user()->email,
        'timestamp' => now()->toDateTimeString(),
    ]);

        $this->reset(['type', 'tickets', 'price']);
        $this->loadPackages();
        session()->flash('success', 'Package created successfully!');
    }

    public function edit($id)
    {
        $package = TicketPackage::findOrFail($id);
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

        $package = TicketPackage::findOrFail($this->package_id);
        $original = $package->toArray();
        $package->update([
            'type' => $this->editType,
            'tickets' => $this->editTickets,
            'price' => $this->editPrice,
        ]);

        adminLog('Updated a ticket package.', [
        'action' => 'update_ticket_package',
        'package_id' => $package->id,
        'original' => $original,
        'updated' => [
            'type' => $this->editType,
            'tickets' => $this->editTickets,
            'price' => $this->editPrice,
        ],
        'performed_by_admin_id' => auth()->id(),
        'performed_by_admin_email' => auth()->user()->email,
        'timestamp' => now()->toDateTimeString(),
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
    $package = TicketPackage::find($this->package_id);

    if ($package) {
        adminLog('Deleted a ticket package.', [
            'action' => 'delete_ticket_package',
            'package_id' => $package->id,
            'type' => $package->type,
            'tickets' => $package->tickets,
            'price' => $package->price,
            'performed_by_admin_id' => auth()->id(),
            'performed_by_admin_email' => auth()->user()->email,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    TicketPackage::destroy($this->package_id);

    $this->resetForm();
    $this->loadPackages();

    session()->flash('success', 'Package deleted successfully!');
    $this->dispatch('close-modal');
}

    public function render()
    {
        return view('livewire.admindashboard.ticket-packages')->layout('components.layouts.Admindashboard');
    }
}

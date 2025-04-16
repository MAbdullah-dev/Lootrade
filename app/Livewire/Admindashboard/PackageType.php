<?php

namespace App\Livewire\Admindashboard;

use App\Models\PackageType as ModelsPackageType;
use Livewire\Component;

class PackageType extends Component
{
    public $name, $editName, $package_type_id;
    public $types;

    public function mount()
    {
        $this->loadTypes();
    }

    public function loadTypes()
    {
        $this->types = ModelsPackageType::latest()->get();
    }

    public function resetForm()
    {
        $this->reset(['name', 'editName', 'package_type_id']);
    }

    protected function rules()
    {
        return ['name' => 'required|string|max:255|unique:package_types,name'];
    }

    public function store()
    {
        $this->validate();

        ModelsPackageType::create(['name' => $this->name]);
        $this->resetForm();
        $this->loadTypes();
        session()->flash('success', 'Package type created successfully!');
    }

    public function edit($id)
    {
        $type = ModelsPackageType::findOrFail($id);
        $this->package_type_id = $type->id;
        $this->editName = $type->name;
    }

    public function update()
    {
        $this->validate([
            'editName' => 'required|string|max:255|unique:package_types,name,' . $this->package_type_id,
        ]);

        $type = ModelsPackageType::findOrFail($this->package_type_id);
        $type->update(['name' => $this->editName]);

        $this->resetForm();
        $this->loadTypes();
        session()->flash('success', 'Package type updated successfully!');
        $this->dispatch('close-modal');
    }

    public function delete($id)
{
    $this->package_type_id = $id;
}

public function confirmDelete()
{
    ModelsPackageType::destroy($this->package_type_id);
    $this->resetForm();
    $this->loadTypes();
    session()->flash('success', 'Package type deleted successfully!');
    $this->dispatch('close-modal');
}
    public function render()
    {
        return view('livewire.admindashboard.package-type')
            ->layout('components.layouts.Admindashboard');
    }
}

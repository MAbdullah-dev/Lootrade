<div class="packages">
    <form wire:submit.prevent="store" class="mt-4">
        <div class="mb-3">
            <label for="type" class="form-label">Package Type</label>
            <select id="type" class="form-select" wire:model="type">
                <option value="">-- Select Package Type --</option>
                <option value="Basic Package">Basic Package</option>
                <option value="Premium Package">Premium Package</option>
                <option value="Elite Package">Elite Package</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tickets" class="form-label">Number of Tickets</label>
            <input type="number" id="tickets" class="form-control" wire:model="tickets">
            @error('tickets')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" class="form-control" wire:model="price">
            @error('price')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-end">
            <button type="submit" class="btn-custom">Create Package</button>
        </div>
    </form>
    <h4>All Packages</h4>
    <div class="table-responsive rounded shadow mt-4">
        <table class="table table-dark table-hover mb-2">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Tickets</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $index => $package)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $package->type }}</td>
                        <td>{{ $package->tickets }}</td>
                        <td>${{ number_format($package->price, 2) }}</td>
                        <td>
                            <button wire:click="edit({{ $package->id }})" class="btn btn-sm btn-warning me-2">
                                Update
                            </button>
                            <button wire:click="delete({{ $package->id }})" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No packages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

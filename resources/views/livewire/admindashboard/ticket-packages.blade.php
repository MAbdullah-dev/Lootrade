<div class="ticketpackages">
    <form wire:submit.prevent="store" class="mt-4">
        <div class="mb-3">
            <label for="type" class="form-label">Package Type</label>
            <select id="type" class="form-select" wire:model="type">
                <option value="">-- Select Package Type --</option>
                @foreach ($packagesTypes as $packageType)
                    <option value="{{ $packageType->name }}">{{ $packageType->name }}</option>
                @endforeach
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

    <h4 class="mt-3 gradient">All Packages</h4>
    <div class="table-responsive rounded mt-4">
        <table class="table table-neon table-hover mb-2">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Tickets</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $index => $package)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $package->type }}</td>
                        <td>{{ $package->tickets }}</td>
                        <td>${{ number_format($package->price, 2) }}</td>
                        <td>
                            <button wire:click="edit({{ $package->id }})" data-bs-toggle="modal"
                                data-bs-target="#updateModal" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="delete({{ $package->id }})" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
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

    {{-- Update Modal --}}
    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="update" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Package Type</label>
                        <select class="form-select" wire:model="editType">
                            <option value="">Select Type</option>
                            <option value="Basic Package">Basic Package</option>
                            <option value="Premium Package">Premium Package</option>
                            <option value="Elite Package">Elite Package</option>
                        </select>
                        @error('editType')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Tickets</label>
                        <input type="number" class="form-control" wire:model="editTickets">
                        @error('editTickets')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" wire:model="editPrice">
                        @error('editPrice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetForm">Cancel</button>
                    <button type="submit" class="btn-custom">Update Package</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this package?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetForm">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', () => {
            $('#updateModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush

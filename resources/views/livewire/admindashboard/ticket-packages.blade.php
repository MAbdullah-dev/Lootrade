<div class="ticketpackages">
    <form wire:submit.prevent="store" class="mt-4" aria-label="Create New Ticket Package Form">
        <div class="mb-3">
            <label for="type" class="form-label">Package Type</label>
            <select id="type" class="form-select" wire:model="type" aria-describedby="typeHelp">
                <option value="">-- Select Package Type --</option>
                @foreach ($packagesTypes as $packageType)
                    <option value="{{ $packageType->name }}">{{ $packageType->name }}</option>
                @endforeach
            </select>
            @error('type')
                <span class="text-danger" id="typeHelp">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tickets" class="form-label">Number of Tickets</label>
            <input type="number" id="tickets" class="form-control" wire:model="tickets" aria-describedby="ticketsHelp">
            @error('tickets')
                <span class="text-danger" id="ticketsHelp">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" id="price" class="form-control" wire:model="price" aria-describedby="priceHelp">
            @error('price')
                <span class="text-danger" id="priceHelp">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn-custom" aria-label="Submit new package">Create Package</button>
        </div>
    </form>

    <h4 class="mt-3 gradient" id="packagesHeading">All Packages</h4>
    <div class="table-responsive rounded mt-4" role="region" aria-labelledby="packagesHeading">
        <table class="table table-neon table-hover mb-2">
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
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $package->type }}</td>
                        <td>{{ $package->tickets }}</td>
                        <td>${{ number_format($package->price, 2) }}</td>
                        <td>
                            <button wire:click="edit({{ $package->id }})" data-bs-toggle="modal"
                                data-bs-target="#updateModal" class="btn btn-sm btn-warning me-2"
                                aria-label="Edit package {{ $package->type }}">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </button>
                            <button wire:click="delete({{ $package->id }})" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" class="btn btn-sm btn-danger"
                                aria-label="Delete package {{ $package->type }}">
                                <i class="fas fa-trash-alt" aria-hidden="true"></i>
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
        aria-hidden="true" role="dialog" aria-modal="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="update" class="modal-content" aria-label="Update Package Form">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close modal"
                        wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editType" class="form-label">Package Type</label>
                        <select id="editType" class="form-select" wire:model="editType" aria-describedby="editTypeHelp">
                            <option value="">Select Type</option>
                            <option value="Basic Package">Basic Package</option>
                            <option value="Premium Package">Premium Package</option>
                            <option value="Elite Package">Elite Package</option>
                        </select>
                        @error('editType')
                            <span class="text-danger" id="editTypeHelp">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editTickets" class="form-label">Tickets</label>
                        <input type="number" id="editTickets" class="form-control" wire:model="editTickets" aria-describedby="editTicketsHelp">
                        @error('editTickets')
                            <span class="text-danger" id="editTicketsHelp">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="editPrice" class="form-label">Price</label>
                        <input type="number" step="0.01" id="editPrice" class="form-control" wire:model="editPrice" aria-describedby="editPriceHelp">
                        @error('editPrice')
                            <span class="text-danger" id="editPriceHelp">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetForm" aria-label="Cancel update">Cancel</button>
                    <button type="submit" class="btn-custom" aria-label="Submit update">Update Package</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true" role="dialog" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content" aria-labelledby="deleteModalLabel">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close modal"
                        wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this package?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetForm" aria-label="Cancel delete">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="confirmDelete" aria-label="Confirm delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', () => {
            const updateModal = document.getElementById('updateModal');
            const deleteModal = document.getElementById('deleteModal');

            if (updateModal) $('#updateModal').modal('hide');
            if (deleteModal) $('#deleteModal').modal('hide');
        });
    </script>
@endpush

<div class="ticket-package-type">
    <div class="mt-4">
        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label for="name" class="form-label">New Package Type</label>
                <input type="text" id="name" wire:model="name" class="form-control"
                    placeholder="Enter package type name">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-end"><button type="submit" class="btn-custom">Add Package Type</button></div>
        </form>

        <h4 class="mt-5">All Package Types</h4>
        <div class="table-responsive rounded mt-4">
            <table class="table table-dark table-hover mb-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Type Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($types as $index => $type)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $type->name }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#updateTypeModal" wire:click.prevent="edit({{ $type->id }})"
                                    title="Edit Type">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteTypeModal" wire:click.prevent="delete({{ $type->id }})"
                                    title="Delete Type">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-3">No package types found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Update Modal -->
    <div wire:ignore.self class="modal fade" id="updateTypeModal" tabindex="-1" aria-labelledby="updateTypeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="update" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Package Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    <input type="text" wire:model="editName" class="form-control" placeholder="Enter new name">
                    @error('editName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetForm">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteTypeModal" tabindex="-1" aria-labelledby="deleteTypeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this package type?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Cancel</button>
                    <button class="btn btn-danger" wire:click="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', () => {
            $('#updateTypeModal').modal('hide');
            $('#deleteTypeModal').modal('hide');
        });
    </script>
@endpush

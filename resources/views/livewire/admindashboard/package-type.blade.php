{{-- Ticket-Package Type Management (Accessible Version) --}}
<section class="ticket-package-type" aria-labelledby="packageTypeHeading">
    <h2 id="packageTypeHeading" class="visually-hidden">Ticket Package Type Management</h2>

    {{-- =====================  Create New Package Type  ===================== --}}
    <form wire:submit.prevent="store" class="mt-4" aria-label="Add Package Type Form">
        <div class="mb-3">
            <label for="name" class="form-label">New Package Type</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter package type name"
                aria-describedby="nameHelp"
                aria-required="true"
                aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
            >
            @error('name')
                <span class="text-danger" id="nameHelp">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit" class="btn-custom" aria-label="Add new package type">
                Add Package Type
            </button>
        </div>
    </form>

    {{-- =====================  Search & Listing  ===================== --}}
    <h4 class="mt-5" id="allPackageTypesHeading">All Package Types</h4>

    <div class="mb-3">
        <label for="searchType" class="visually-hidden">Search package types</label>
        <input
            type="text"
            id="searchType"
            wire:model.live="search"
            class="form-control"
            placeholder="Search package type…"
            aria-label="Search package types"
        >
    </div>

    <div
        class="table-responsive rounded mt-4"
        role="region"
        aria-labelledby="allPackageTypesHeading"
    >
        <table class="table table-neon table-hover mb-2">
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
                            {{-- Edit --}}
                            <button
                                type="button"
                                class="btn btn-sm btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#updateTypeModal"
                                wire:click.prevent="edit({{ $type->id }})"
                                aria-label="Edit package type {{ $type->name }}"
                            >
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </button>

                            {{-- Delete --}}
                            <button
                                type="button"
                                class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteTypeModal"
                                wire:click.prevent="delete({{ $type->id }})"
                                aria-label="Delete package type {{ $type->name }}"
                            >
                                <i class="fas fa-trash" aria-hidden="true"></i>
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

    {{-- =====================  Update Modal  ===================== --}}
    <div
        wire:ignore.self
        class="modal fade"
        id="updateTypeModal"
        tabindex="-1"
        aria-labelledby="updateTypeModalLabel"
        aria-modal="true"
        role="dialog"
    >
        <div class="modal-dialog">
            <form wire:submit.prevent="update" class="modal-content" aria-label="Update Package Type Form">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTypeModalLabel">Update Package Type</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close modal"
                        wire:click="resetForm"
                    ></button>
                </div>

                <div class="modal-body">
                    <label for="editName" class="visually-hidden">Package type name</label>
                    <input
                        type="text"
                        id="editName"
                        wire:model="editName"
                        class="form-control @error('editName') is-invalid @enderror"
                        placeholder="Enter new name"
                        aria-describedby="editNameHelp"
                        aria-required="true"
                        aria-invalid="{{ $errors->has('editName') ? 'true' : 'false' }}"
                    >
                    @error('editName')
                        <span class="text-danger" id="editNameHelp">{{ $message }}</span>
                    @enderror
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        wire:click="resetForm"
                        aria-label="Cancel update"
                    >
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary" aria-label="Save updated package type">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- =====================  Delete Modal  ===================== --}}
    <div
        wire:ignore.self
        class="modal fade"
        id="deleteTypeModal"
        tabindex="-1"
        aria-labelledby="deleteTypeModalLabel"
        aria-modal="true"
        role="dialog"
    >
        <div class="modal-dialog">
            <div class="modal-content" aria-labelledby="deleteTypeModalLabel">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTypeModalLabel">Confirm Deletion</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close modal"
                        wire:click="resetForm"
                    ></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this package type?
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        wire:click="resetForm"
                        aria-label="Cancel delete"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        class="btn btn-danger"
                        wire:click="confirmDelete"
                        aria-label="Confirm delete"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
    <script>
        /**
         * Close both modals when Livewire fires 'close-modal'.
         * Ensures modals are hidden for both mouse and keyboard users.
         */
        window.addEventListener('close-modal', () => {
            $('#updateTypeModal').modal('hide');
            $('#deleteTypeModal').modal('hide');
        });
    </script>
@endpush

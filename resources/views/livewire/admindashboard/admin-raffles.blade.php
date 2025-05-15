<div class="raffleadminDashboard">
    <section class="admin-raffles">
        <div class="inner">
            <div class="head mb-4">
                <div class="row g-3 align-items-center">
                    <div class="col-12 col-md-6">
                        <input type="text" class="form-control" placeholder="Search raffles..." wire:model.live="search">
                    </div>
                    <div class="col-12 col-md-3">
                        <select class="form-select" wire:model.live="sortDirection">
                            <option value="desc">Newest First</option>
                            <option value="asc">Oldest First</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 text-md-end">
                        <button type="button" class="btn-custom" data-bs-toggle="modal"
                            data-bs-target="#createRaffleModal">
                            Create Raffle
                        </button>
                    </div>
                </div>
            </div>

            <!-- Create Raffle Modal -->
            <div wire:ignore.self class="modal fade" id="createRaffleModal" tabindex="-1"
                aria-labelledby="createRaffleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createRaffleModalLabel">Create Raffle</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" wire:model.defer="title"
                                    placeholder="Enter title">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="input-wrapper mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" rows="5" class="form-control" wire:model.defer="description"
                                    placeholder="Enter description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Minimum and Maximum Entries -->
                            <div class="d-flex gap-3 mb-3">
                                <div class="w-50">
                                    <label for="entry_cost" class="form-label">Minimum Tickets to Enter</label>
                                    <input type="number" id="entry_cost" class="form-control"
                                        wire:model.defer="entry_cost" placeholder="Min Tickets">
                                    @error('entry_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-50">
                                    <label for="max_entries_per_user" class="form-label">Maximum Entries Per
                                        User</label>
                                    <input type="number" id="max_entries_per_user" class="form-control"
                                        wire:model.defer="max_entries_per_user" placeholder="Max Entries">
                                    @error('max_entries_per_user')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="mb-3">
                                <div wire:ignore class="input-wrapper">
                                    <label for="date_range" class="form-label">Raffle Duration</label>
                                    <input type="text" id="date_range" class="form-control"
                                        wire:model.defer="date_range" placeholder="Select start and end date" readonly>
                                </div>
                                @error('date_range')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Slots -->
                            <div class="input-wrapper mb-3">
                                <label for="slots" class="form-label">Slots (Number of users that can enter)</label>
                                <input type="number" id="slots" class="form-control" wire:model.defer="slots"
                                    placeholder="Enter Slots">
                                @error('slots')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="prize" class="form-label">Prize (No of Tickets as Reward)</label>
                                <input type="number" id="prize" class="form-control" wire:model.defer="prize"
                                    placeholder="Enter prize">
                                @error('prize')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" id="image" class="form-control" wire:model="image">
                                <div wire:loading wire:target="image" class="text-primary mt-2">Uploading Image...
                                </div>
                                @if ($image)
                                    <div class="text-success mt-2">Image Uploaded Successfully!</div>
                                @endif
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn-custom" wire:click="createRaffle">Save Raffle</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Edit Raffle Modal -->
            <div wire:ignore.self class="modal fade" id="editRaffleModal" tabindex="-1"
                aria-labelledby="editRaffleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editRaffleModalLabel">Edit Raffle</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Title -->
                            <div class="input-wrapper mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" wire:model.defer="title"
                                    placeholder="Enter title">
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="input-wrapper mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" rows="5" class="form-control" wire:model.defer="description"
                                    placeholder="Enter description"></textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Minimum and Maximum Entries -->
                            <div class="d-flex gap-3 mb-3">
                                <div class="w-50">
                                    <label for="entry_cost" class="form-label">Minimum Tickets to Enter</label>
                                    <input type="number" id="entry_cost" class="form-control"
                                        wire:model.defer="entry_cost" placeholder="Min Tickets">
                                    @error('entry_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="w-50">
                                    <label for="max_entries_per_user" class="form-label">Maximum Entries Per
                                        User</label>
                                    <input type="number" id="max_entries_per_user" class="form-control"
                                        wire:model.defer="max_entries_per_user" placeholder="Max Entries">
                                    @error('max_entries_per_user')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- Date Range -->
                            <div class="mb-3">
                                <div wire:ignore class="input-wrapper">
                                    <label for="date_range_edit" class="form-label">Raffle Duration</label>
                                    <input type="text" id="date_range_edit" class="form-control"
                                        wire:model.defer="date_range"
                                        placeholder="{{ $date_range ?? 'Select start and end date' }}" readonly>
                                </div>
                                <h6 style="background-color: #fe3839; color: #ffffff; padding: 5px;"
                                    class="mt-2 w-100 fw-bold">Your Selected Date: <br> {{ $date_range }}</span>
                                    @error('date_range')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            <!-- Slots -->
                            <div class="input-wrapper mb-3">
                                <label for="slots" class="form-label">Slots (Number of users that can
                                    enter)</label>
                                <input type="number" id="slots" class="form-control" wire:model.defer="slots"
                                    placeholder="Enter Slots">
                                @error('slots')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Prize -->
                            <div class="input-wrapper mb-3">
                                <label for="prize" class="form-label">Prize (No of Tickets as Reward)</label>
                                <input type="number" id="prize" class="form-control" wire:model.defer="prize"
                                    placeholder="Enter prize">
                                @error('prize')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Upload Picture -->
                            <div class="input-wrapper mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" id="image" class="form-control" wire:model="image">
                                <div wire:loading wire:target="image" class="text-primary mt-2">Uploading Image...
                                </div>
                                @if ($image)
                                    <div class="text-success mt-2">Image Uploaded Successfully!</div>
                                @endif
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn-custom"
                                wire:click="updateRaffle({{ $raffle_id }})">Update Raffle</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Raffle Table -->
            <div class="table-responsive">
                <table class="table table-neon table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Prize</th>
                            <th>Entries</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($raffles as $index => $raffle)
                            <tr>
                                <td>{{ $raffles->firstItem() + $index }}</td>
                                <td>{{ $raffle->title }}</td>
                                <td>{{ $raffle->prize ?? '-' }}</td>
                                <td>{{ $raffle->entry_cost }} Min / {{ $raffle->max_entries_per_user }} Max</td>
                                <td>{{ $raffle->start_date->format('M d, Y') }}</td>
                                <td>{{ $raffle->end_date->format('M d, Y') }}</td>
                                <td>{{ ucfirst($raffle->status) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-secondary"
                                            wire:click="viewRaffle({{ $raffle->id }})">
                                            <i class="fa-solid fa-user"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editRaffleModal"
                                            wire:click="viewForEditRaffle({{ $raffle->id }})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="deleteRaffle({{ $raffle->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No raffles found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $raffles->links() }}
                </div>
            </div>
        </div>
    </section>

    <script>
        $("#date_range").flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",
            enableTime: true,
            altInput: true,
            altFormat: "F j, Y H:i",
            allowInput: true,
            time_24hr: true,
        });
        $("#date_range_edit").flatpickr({
            mode: "range",
            dateFormat: "Y-m-d",
            enableTime: true,
            altInput: true,
            altFormat: "F j, Y H:i",
            allowInput: true,
            time_24hr: true,
        });

        Livewire.on('raffleCreated', () => {
            $('#createRaffleModal').modal('hide');
        });

        Livewire.on('hideEditModal', () => {
            $('#editRaffleModal').modal('hide');
        });

        Livewire.on('showEditModal', () => {
            flatpickr("#date_range_edit", {
                mode: "range",
                dateFormat: "Y-m-d",
                enableTime: true,
                altInput: true,
                altFormat: "F j, Y H:i",
                allowInput: true,
                time_24hr: true,
            });
        });
    </script>
</div>

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
                        <a href="{{ route('raffle.create') }}" type="button" class="btn-custom">
                            Create Raffle
                        </a>
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
                                @php
                                    $prizes = json_decode($raffle->prize);
                                @endphp

                                <td>{{ $prizes[0]->name ?? '-' }}</td>

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
</div>

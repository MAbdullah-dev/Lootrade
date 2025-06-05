<div class="raffleadminDashboard" aria-label="Raffle Admin Dashboard">
    <section class="admin-raffles" aria-labelledby="rafflesSectionHeading">
        <div class="inner">
            <h2 id="rafflesSectionHeading" class="visually-hidden">Manage Raffles</h2>

            <!-- Search and Filter Controls -->
            <div class="head mb-4">
                <div class="row g-3 align-items-center" role="search" aria-label="Search and Sort Raffles">
                    <div class="col-12 col-md-6">
                        <label for="searchRaffles" class="visually-hidden">Search Raffles</label>
                        <input
                            type="text"
                            id="searchRaffles"
                            class="form-control"
                            placeholder="Search raffles..."
                            wire:model.live="search"
                            aria-label="Search raffles by title or prize"
                        >
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="sortDirection" class="visually-hidden">Sort Raffles</label>
                        <select
                            id="sortDirection"
                            class="form-select"
                            wire:model.live="sortDirection"
                            aria-label="Sort raffles by newest or oldest"
                        >
                            <option value="desc">Newest First</option>
                            <option value="asc">Oldest First</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 text-md-end">
                        <a
                            href="{{ route('raffle.create') }}"
                            type="button"
                            class="btn-custom"
                            role="button"
                            aria-label="Create a new raffle"
                        >
                            Create Raffle
                        </a>
                    </div>
                </div>
            </div>

            <!-- Raffle Table -->
            <div class="table-responsive" role="region" aria-label="Raffles Table">
                <table class="table table-neon table-hover" aria-describedby="rafflesTableCaption">
                    <caption id="rafflesTableCaption" class="visually-hidden">
                        This table shows a list of raffles including title, prize, entries, start and end dates, status, and action buttons.
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Prize</th>
                            <th scope="col">Entries</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($raffles as $index => $raffle)
                            <tr>
                                <td>{{ $raffles->firstItem() + $index }}</td>
                                <td>{{ $raffle->title }}</td>
                                <td>{{ $raffle->prize ?? '-' }}</td>
                                <td>
                                    {{ $raffle->entry_cost }} Min / {{ $raffle->max_entries_per_user }} Max
                                </td>
                                <td>{{ $raffle->start_date->format('M d, Y') }}</td>
                                <td>{{ $raffle->end_date->format('M d, Y') }}</td>
                                <td>{{ ucfirst($raffle->status) }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button
                                            class="btn btn-sm btn-secondary"
                                            wire:click="viewRaffle({{ $raffle->id }})"
                                            aria-label="View raffle details"
                                        >
                                            <i class="fa-solid fa-user" aria-hidden="true"></i>
                                        </button>
                                        <button
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRaffleModal"
                                            wire:click="viewForEditRaffle({{ $raffle->id }})"
                                            aria-label="Edit raffle"
                                        >
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            wire:click="deleteRaffle({{ $raffle->id }})"
                                            aria-label="Delete raffle"
                                        >
                                            <i class="fa fa-trash" aria-hidden="true"></i>
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
                <div class="mt-3" role="navigation" aria-label="Pagination Navigation">
                    {{ $raffles->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Optional utility class for screen-reader-only elements -->

    <style>
    .visually-hidden {
        position: absolute !important;
        height: 1px;
        width: 1px;
        overflow: hidden;
        clip: rect(1px, 1px, 1px, 1px);
        white-space: nowrap;
    }
    </style>
</div>

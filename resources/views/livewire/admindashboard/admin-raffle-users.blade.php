<div style="flex: 1" class="admin-raffle-users" aria-label="Raffle Users Section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 id="raffleUsersHeading">Raffle: {{ $raffle->title }}</h2>
    </div>

    <div class="d-flex mb-3 gap-3" role="search" aria-label="Search Users">
        <label for="searchUsers" class="visually-hidden">Search by name or email</label>
        <input
            type="text"
            id="searchUsers"
            class="form-control w-50"
            placeholder="Search by name or email..."
            wire:model="search"
            aria-label="Search users by name or email"
        >
    </div>

    <div class="table-responsive" role="region" aria-labelledby="raffleUsersHeading">
        <table class="table table-neon table-hover" aria-describedby="raffleUsersCaption">
            <caption id="raffleUsersCaption" class="visually-hidden">
                This table displays users who have entered the raffle along with their tickets.
            </caption>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tickets</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($entries as $index => $entry)
                    <tr>
                        <td>{{ $entries->firstItem() + $index }}</td>
                        <td>{{ $entry->user->name }}</td>
                        <td>{{ $entry->user->email }}</td>
                        <td>{{ $entry->ticket_code }}</td>
                        <td>
                            <button
                                class="btn btn-sm btn-primary"
                                aria-label="View tickets for {{ $entry->user->name }}"
                            >
                                View Tickets
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No entries found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3" role="navigation" aria-label="Pagination Navigation">
            {{ $entries->links() }}
        </div>
    </div>
</div>


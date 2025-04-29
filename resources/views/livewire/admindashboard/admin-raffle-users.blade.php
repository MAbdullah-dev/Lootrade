<div style="flex: 1" class="admin-raffle-users">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Raffle: {{ $raffle->title }}</h2>
    </div>

    <div class="d-flex mb-3 gap-3">
        <input type="text" class="form-control w-50" placeholder="Search by name or email..." wire:model="search">
    </div>

    <div class="table-responsive">
        <table class="table table-neon  table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Tickets</th>
                    <th>Actions</th>
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
                            <button class="btn btn-sm btn-primary">
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

        <div class="mt-3">
            {{ $entries->links() }}
        </div>
    </div>
</div>

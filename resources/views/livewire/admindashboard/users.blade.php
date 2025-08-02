<div class="users">
    <div class="head mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-6">
                <input type="text" class="form-control" placeholder="Search users..."
                       aria-label="Search users" wire:model.live="searchQuery">
            </div>
            {{-- Sorting select (uncomment if needed) --}}
        </div>
    </div>

    <!-- Rest of your table and modals remain unchanged -->
    <div class="table-responsive rounded shadow">
        <table class="table table-neon table-hover mb-0">
            <thead class="thead">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                    @if ($isSuperAdmin)
                        <th scope="col">Promote</th>
                    @endif
                    <th scope="col">Give ticket</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($users))
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames()->first() ?? 'N/A' }}</td>
                            <td>
                                @if ($user->trashed())
                                    <span class="badge bg-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            @if ($isSuperAdmin)
                                <td>
                                    @if ($user->hasRole('user'))
                                        <button class="btn btn-sm btn-warning mx-content"
                                            wire:click="promoteToAdmin({{ $user->id }})">
                                            Promote to Admin
                                        </button>
                                    @elseif ($user->hasRole('admin'))
                                        <button class="btn btn-sm btn-secondary"
                                            wire:click="reassignToUser({{ $user->id }})">
                                            Reassign to User
                                        </button>
                                    @endif
                                </td>
                            @endif
                            <td>
                                <button class="btn btn-sm btn-success mx-content" data-bs-toggle="modal"
                                    data-bs-target="#giveTicketModal"
                                    wire:click="prepareToGiveTickets({{ $user->id }})">
                                    Give Ticket
                                </button>
                            </td>
                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#userDetailModal" wire:click="viewUser({{ $user->id }})">
                                    View
                                </button>
                                @if ($user->trashed())
                                    <button class="btn btn-sm btn-success"
                                        wire:click="unblockUser({{ $user->id }})">
                                        Unblock
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-danger" wire:click="blockUser({{ $user->id }})">
                                        Block
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <td class="text-center" colspan="8">No users found</td>
                @endif
            </tbody>
        </table>
    </div>

    <!-- User Detail Modal and Give Ticket Modal remain unchanged -->
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', () => {
            $('#giveTicketModal').modal('hide');
        });
    </script>
@endpush

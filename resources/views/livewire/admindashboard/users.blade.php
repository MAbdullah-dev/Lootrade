<div class="users">
    <div class="head mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-6">
                <input type="text" class="form-control" placeholder="Search raffles..." aria-label="Search raffles">
            </div>
            <div class="col-12 col-md-3">
                <select class="form-select" aria-label="Sort raffles">
                    <option value="desc">Newest First</option>
                    <option value="asc">Oldest First</option>
                </select>
            </div>
        </div>
    </div>

    <div class="table-responsive rounded shadow">
        <table class="table table-neon  table-hover mb-0">
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
                            <td>{{ $user->role->name ?? 'N/A' }}</td>
                            <td>
                                @if ($user->trashed())
                                    <span class="badge bg-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </td>
                            @if ($isSuperAdmin)
                                <td>
                                    @if ($user->role_id == 1)
                                        <button class="btn btn-sm btn-warning mx-content"
                                            wire:click="promoteToAdmin({{ $user->id }})">
                                            Promote to Admin
                                        </button>
                                    @elseif ($user->role_id == 2)
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
                    <td class="text-center" colspan="8">N/A</td>
                @endif
            </tbody>
        </table>
    </div>

    <!-- User Detail Modal -->
    <div wire:ignore.self wire:ignore.self class="modal fade" id="userDetailModal" tabindex="-1"
        aria-labelledby="userDetailModalLabel" aria-modal="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="userDetailModalLabel">
                        User Details - {{ $selectedUser['first_name'] ?? '' }} {{ $selectedUser['last_name'] ?? '' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        wire:click="resetSelectedUser"></button>
                </div>
                <div class="modal-body">
                    @if ($selectedUser)
                        <p><strong>Username:</strong> {{ $selectedUser['username'] }}</p>
                        <p><strong>Email:</strong> {{ $selectedUser['email'] }}</p>
                        <p><strong>Role:</strong> {{ $selectedUser['role']['name'] ?? 'N/A' }}</p>
                        <p><strong>Status:</strong>
                            @if ($selectedUser['deleted_at'])
                                <span class="badge bg-secondary">Inactive</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </p>
                        <p><strong>Joined Date:</strong> {{ $selectedUser['joined_date'] }}</p>
                        <p><strong>Ticket Balance:</strong> {{ $selectedUser['ticket_balance'] }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetSelectedUser">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Give Ticket Modal -->
    <div wire:ignore.self wire:ignore.self class="modal fade" id="giveTicketModal" tabindex="-1"
        aria-labelledby="giveTicketModalLabel" aria-modal="true" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="giveTickets" class="modal-content shadow">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="giveTicketModalLabel">Give Tickets to
                        {{ $selectedUser['first_name'] ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ticketCount" class="form-label">Number of Tickets</label>
                        <input type="number" min="1" wire:model="ticketCount"
                            class="form-control @error('ticketCount') is-invalid @enderror" id="ticketCount"
                            placeholder="Enter number of tickets" aria-required="true"
                            aria-invalid="{{ $errors->has('ticketCount') ? 'true' : 'false' }}"
                            @error('ticketCount') aria-describedby="ticketCountError" @enderror>
                        @error('ticketCount')
                            <span id="ticketCountError" class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        wire:click="resetForm">Cancel</button>
                    <button type="submit" class="btn btn-success">Give</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        window.addEventListener('close-modal', () => {
            $('#giveTicketModal').modal('hide');
        });
    </script>
@endpush

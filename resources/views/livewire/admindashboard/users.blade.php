<div class="users">
    <h5 class="mb-4">Users</h5>

    <div class="table-responsive rounded shadow">
        <table class="table table-dark table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
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
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#userDetailModal"
                                wire:click="viewUser({{ $user->id }})">
                                View
                            </button>

                            @if ($user->trashed())
                                <button class="btn btn-sm btn-success" wire:click="unblockUser({{ $user->id }})">
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
            </tbody>
        </table>
    </div>
    <div wire:ignore.self class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel"
        aria-hidden="true">
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

</div>

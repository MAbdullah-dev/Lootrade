<div class="mytickets">
    <h5 class="mb-4">My Tickets</h5>

    <div class="mb-4 px-4">
        <input type="text" wire:model.live="search" class="form-control" placeholder="Search by ticket number...">
    </div>

    <!-- Responsive wrapper -->
    <div class="table-responsive rounded">
        <table class="table table-dark table-hover table-bordered mb-0">
            <thead class="thead-light">
                <tr>
                    <th wire:click="sortBy('ticket_number')" style="cursor: pointer;">
                        Ticket Number
                        @if ($sortField === 'ticket_number')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>
                    <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                        Date
                        @if ($sortField === 'created_at')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>
                    <th>Status</th>
                    <th>Acquisition Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>#{{ $ticket->ticket_number }}</td>
                        <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if ($ticket->status === 'available')
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-secondary">Assigned</span>
                            @endif
                        </td>
                        <td>{{ ucfirst($ticket->acquisition_type) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No tickets found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
</div>

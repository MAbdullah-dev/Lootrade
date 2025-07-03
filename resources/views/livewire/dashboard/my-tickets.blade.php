<section class="mytickets mt-2" aria-labelledby="myTicketsHeading">
    <div class="mb-4">
        <label for="searchTickets" class="form-label visually-hidden">Search by ticket number</label>
        <input
            type="text"
            id="searchTickets"
            wire:model.live="search"
            class="form-control"
            placeholder="Search by ticket number..."
            aria-label="Search by ticket number"
        >
    </div>

    <div class="table-responsive rounded" role="region" aria-labelledby="myTicketsHeading">
        <table class="table table-neon table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th
                        scope="col"
                        wire:click="sortBy('ticket_number')"
                        style="cursor: pointer;"
                        aria-sort="{{ $sortField === 'ticket_number' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}"
                    >
                        Ticket Number
                        @if ($sortField === 'ticket_number')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>
                    <th
                        scope="col"
                        wire:click="sortBy('created_at')"
                        style="cursor: pointer;"
                        aria-sort="{{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}"
                    >
                        Date
                        @if ($sortField === 'created_at')
                            {{ $sortDirection === 'asc' ? '▲' : '▼' }}
                        @endif
                    </th>
                    <th scope="col">Status</th>
                    <th scope="col">Acquisition Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>#{{ $ticket->ticket_number }}</td>
                        <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if ($ticket->status === 'available')
                                <span class="badge bg-success" role="status" aria-label="Ticket Available">Available</span>
                            @else
                                <span class="badge bg-secondary" role="status" aria-label="Ticket Assigned">Assigned</span>
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

    <nav class="mt-2" aria-label="Ticket pagination">
        {{ $tickets->links() }}
    </nav>
</section>

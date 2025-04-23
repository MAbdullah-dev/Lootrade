<section class="support-section">
    {{-- <div class="container"> --}}
    <div class="inner">
        <div class="form-wrapper mx-auto px-4">
            <h5 class="text-center mb-4">Support Ticket</h5>
            <form class="mx-auto" wire:submit.prevent="submit">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" id="subject" class="form-control" wire:model.defer="subject"
                        placeholder="Enter subject">
                    @error('subject')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control" rows="5" wire:model.defer="description"
                        placeholder="Describe your issue..."></textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-custom w-100">Submit Ticket</button>
            </form>
        </div>

        <div class="ticket-list mt-5 mx-auto">
            <h5 class="mb-4">Tickets Initiated</h5>

            <input type="text" class="form-control mb-3 w-50" placeholder="Search Tickets..."
                wire:model.live="search">

            <div class="table-responsive rounded shadow">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->subject }}</td>
                                <td>
                                    @if ($ticket->status == 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif($ticket->status == 'in_progress')
                                        <span class="badge bg-warning text-dark">In Progress</span>
                                    @else
                                        <span class="badge bg-secondary">Closed</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No tickets found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tickets->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    {{-- </div> --}}
</section>

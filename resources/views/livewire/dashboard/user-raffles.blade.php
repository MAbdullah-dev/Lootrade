<section class="user-raffles" aria-labelledby="raffles-heading">
    <div class="body table-responsive rounded shadow">
        <input type="text" class="form-control mb-3" placeholder="Search raffles..." wire:model.debounce.300ms="search">

        <table class="table table-neon table-hover mb-0">
            <caption class="visually-hidden">List of your raffles including name, description, dates, and status
            </caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Raffle Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($raffles as $raffle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $raffle->title }}</td>
                        <td>{{ Str::limit($raffle->description, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($raffle->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($raffle->end_date)->format('d M Y') }}</td>
                        {{-- <td>{{ $raffle->user_tickets_count }} Tickets</td> --}}
                        <td>
                            @php
                                $now = now();
                                if ($raffle->start_date > $now) {
                                    $status = '<span class="text-warning fw-bold">Upcoming</span>';
                                } elseif ($raffle->end_date < $now) {
                                    $status = '<span class="text-danger fw-bold">Closed</span>';
                                } else {
                                    $status = '<span class="text-success fw-bold">Active</span>';
                                }
                            @endphp
                            {!! $status !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No raffles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $raffles->links() }}
        </div>
    </div>
</section>

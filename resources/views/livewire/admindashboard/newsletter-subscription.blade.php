<div class="news-letter p-3">
    <div class="d-flex justify-content-end mb-3">
        {{-- <h2>Newsletter Subscribers</h2> --}}
        <button wire:click="exportCsv" class="btn-custom p-2">
            Download CSV
        </button>
    </div>

    @if ($subscribers->isEmpty())
        <div class="alert alert-warning">
            No subscribers yet!
        </div>
    @else
        <div class="table-responsive rounded mt-4">
            <table class="table table-neon  table-hover mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Subscribed At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $index => $subscriber)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

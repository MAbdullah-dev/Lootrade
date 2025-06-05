<section class="admin-winners">
    <div class="container">
        <div class="inner">
            <div class="row filter-section mb-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <input type="text" placeholder="Search" class="form-control search-bar">
                </div>
                {{-- <div class="col-md-6">
                    <input type="text" placeholder="Date Range" class="form-control date-range">
                </div> --}}
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button wire:click="export" class="btn-custom p-2">Export to Excel</button>
            </div>

            <div class="table-responsive">
                <table class="table table-neon  table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Prize</th>
                            <th>Winner</th>
                            <th>Awarded At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($winners as $winner)
                            <tr>
                                <td>{{ $winner->id }}</td>
                                <td>{{ $winner->raffle?->title ?? 'N/A' }}</td>
                                <td>{{ $winner->prize }}</td>
                                <td>{{ $winner->user?->username ?? 'N/A' }}</td>
                                <td>
                                    {{ $winner->awarded_at?->format('F j, Y g:i A') ?? 'N/A' }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No winners found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>

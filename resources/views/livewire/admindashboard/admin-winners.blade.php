<section class="admin-winners" aria-label="Admin Winners Section">
    <div class="container">
        <div class="inner">
            <h2 class="visually-hidden">List of Contest Winners</h2>

            <!-- Filter Inputs -->
            <div class="row filter-section mb-4" role="search" aria-label="Filter Winners">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="searchInput" class="visually-hidden">Search Winners</label>
                    <input type="text" id="searchInput" placeholder="Search" class="form-control search-bar"
                        aria-label="Search Winners by Name or Title">
                </div>
                {{-- <div class="col-md-6">
                    <input type="text" placeholder="Date Range" class="form-control date-range">
                </div> --}}
            </div>

            <div class="d-flex justify-content-end mb-3">
                <button wire:click="export" class="btn-custom p-2">Export to Excel</button>
            </div>

            <div class="table-responsive rounded shadow">
                <table class="table table-neon  table-hover mb-0">
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
                                <td colspan="5" class="text-center">No winners found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</section>

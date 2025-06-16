<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Admin Logs</h3>
        <button wire:click="exportLogs" class="btn btn-outline-primary">
            <i class="bi bi-download"></i> Export CSV
        </button>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Search actions or target user...">
        </div>
        <div class="col-md-3">
            <input type="date" wire:model="fromDate" class="form-control">
        </div>
        <div class="col-md-3">
            <input type="date" wire:model="toDate" class="form-control">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Admin</th>
                    <th>Target User</th>
                    <th>IP Address</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->description }}</td>
                        <td>{{ optional($log->causer)->username}}</td>
                        <td>{{ $log->properties['target_user_name'] ?? '-' }}</td>
                        <td>{{ $log->properties['ip'] ?? '-' }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $logs->links() }}
    </div>
</div>

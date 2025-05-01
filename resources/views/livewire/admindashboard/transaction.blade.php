<div class="transaction">

    <input type="text" wire:model.live="search" class="form-control mb-3"
        placeholder="Search by username or package..." />

    <div class="body table-responsive rounded ">
        <table class="table table-neon table-hover mb-0">
            <thead>
                <tr>
                    <th wire:click="sortBy('id')">#</th>
                    <th wire:click="sortBy('user.username')">User Name</th>
                    <th wire:click="sortBy('ticketPackage.type')">Package Name</th>
                    <th wire:click="sortBy('package_quantity')">Quantity</th>
                    <th wire:click="sortBy('total_tickets')">Total Tickets</th>
                    <th wire:click="sortBy('total_price')">Total Price</th>
                    <th>Status</th>
                    <th>Transaction ID</th>
                    <th wire:click="sortBy('created_at')">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                    <tr>
                        <td>{{ $loop->iteration + ($transactions->firstItem() - 1) }}</td>
                        <td>{{ $transaction->user->username }}</td>
                        <td>{{ $transaction->ticketPackage->type ?? 'N/A' }}</td>
                        <td>{{ $transaction->package_quantity }}</td>
                        <td>{{ $transaction->total_tickets }}</td>
                        <td>${{ number_format($transaction->total_price, 2) }}</td>
                        <td>
                            @if ($transaction->payment_status === 'paid')
                                <span class="text-success fw-bold">Paid</span>
                            @elseif($transaction->payment_status === 'failed')
                                <span class="text-danger fw-bold">Failed</span>
                            @else
                                <span class="text-warning fw-bold">Pending</span>
                            @endif
                        </td>
                        <td>
                            {{ \Illuminate\Support\Str::limit($transaction->stripe_transaction_id, 12, '...') }}
                            <i class="fa-solid fa-clone" style="cursor:pointer"
                                onclick="navigator.clipboard.writeText('{{ $transaction->stripe_transaction_id }}')"></i>
                        </td>
                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $transactions->links() }}
    </div>
</div>

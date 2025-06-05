<section class="transaction" aria-labelledby="transactions-heading">
    <h2 id="transactions-heading" class="mb-3 gradient">Transactions</h2>

    <label for="search" class="visually-hidden">Search by package</label>
    <input type="text" id="search" wire:model.live="search" class="form-control mb-3" placeholder="Search by package..." />

    <div class="body table-responsive rounded shadow">
        <table class="table table-neon table-hover mb-0">
            <caption class="visually-hidden">Transaction list with package, status, and price details</caption>
            <thead>
                <tr>
                    <th scope="col" wire:click="sortBy('id')" tabindex="0">#</th>
                    <th scope="col" wire:click="sortBy('ticketPackage.type')" tabindex="0">Package Name</th>
                    <th scope="col" wire:click="sortBy('package_quantity')" tabindex="0">Quantity</th>
                    <th scope="col" wire:click="sortBy('total_tickets')" tabindex="0">Total Tickets</th>
                    <th scope="col" wire:click="sortBy('total_price')" tabindex="0">Total Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Transaction ID</th>
                    <th scope="col" wire:click="sortBy('created_at')" tabindex="0">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                    <tr>
                        <th scope="row">{{ $loop->iteration + ($transactions->firstItem() - 1) }}</th>
                        <td>{{ $transaction->ticketPackage->type ?? 'N/A' }}</td>
                        <td>{{ $transaction->package_quantity }}</td>
                        <td>{{ $transaction->total_tickets }}</td>
                        <td>${{ number_format($transaction->total_price, 2) }}</td>
                        <td>
                            @if ($transaction->payment_status === 'paid')
                                <span class="text-success fw-bold" aria-label="Payment status: Paid">Paid</span>
                            @elseif($transaction->payment_status === 'failed')
                                <span class="text-danger fw-bold" aria-label="Payment status: Failed">Failed</span>
                            @else
                                <span class="text-warning fw-bold" aria-label="Payment status: Pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <span>{{ \Illuminate\Support\Str::limit($transaction->stripe_transaction_id, 12, '...') }}</span>
                            <button class="btn btn-sm btn-light border-0"
                                aria-label="Copy transaction ID"
                                onclick="navigator.clipboard.writeText('{{ $transaction->stripe_transaction_id }}')">
                                <i class="fa-solid fa-clone" aria-hidden="true"></i>
                            </button>
                        </td>
                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center" aria-live="polite">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3" role="navigation" aria-label="Pagination Navigation">
            {{ $transactions->links() }}
        </div>
    </div>
</section>

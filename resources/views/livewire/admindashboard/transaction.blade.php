<div class="transacton">
    <h2 class="mb-3">Transactions :</h2>
    <div class="body table-responsive rounded shadow">
        <table class="table table-dark table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Package Name</th>
                    <th>Quantity</th>
                    <th>Total Tickets</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Transaction ID</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $index => $transaction)
                    <tr>
                        <th>{{ $index + 1 }}</th>
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
                        <td>{{ Str::limit($transaction->stripe_transaction_id, 12, '...') }} <i class="fa-solid fa-clone"
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
</div>

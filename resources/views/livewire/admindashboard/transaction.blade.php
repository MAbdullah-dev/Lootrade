{{-- Transaction Table – Accessible Version --}}
<section class="transaction mt-2" aria-labelledby="transactionHeading">
    {{-- Search input --}}
    <div class="mb-3">
        <label for="transactionSearch" class="form-label visually-hidden">
            Search transactions by username or package
        </label>
        <input type="text" id="transactionSearch" wire:model.live="search" class="form-control"
            placeholder="Search by username or package…" aria-label="Search transactions by username or package" />
    </div>

    {{-- Responsive table wrapper --}}
    <div class="body table-responsive rounded" role="region" aria-labelledby="transactionHeading">
        <table class="table table-neon table-hover mb-0">
            <thead>
                <tr>
                    <th scope="col" wire:click="sortBy('id')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'id' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        #
                    </th>
                    <th scope="col" wire:click="sortBy('user.username')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'user.username' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        User Name
                    </th>
                    <th scope="col" wire:click="sortBy('ticketPackage.type')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'ticketPackage.type' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        Package Name
                    </th>
                    <th scope="col" wire:click="sortBy('package_quantity')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'package_quantity' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        Quantity
                    </th>
                    <th scope="col" wire:click="sortBy('total_tickets')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'total_tickets' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        Total Tickets
                    </th>
                    <th scope="col" wire:click="sortBy('total_price')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'total_price' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        Total Price
                    </th>
                    <th scope="col">Status</th>
                    <th scope="col">Transaction ID</th>
                    <th scope="col" wire:click="sortBy('created_at')" style="cursor:pointer"
                        aria-sort="{{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? 'ascending' : 'descending') : 'none' }}">
                        Date
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transactions as $index => $transaction)
                    <tr>
                        {{-- Running index accounting for pagination --}}
                        <td>{{ $loop->iteration + ($transactions->firstItem() - 1) }}</td>

                        {{-- Username --}}
                        <td>{{ $transaction->user->username }}</td>

                        {{-- Package type --}}
                        <td>{{ $transaction->ticketPackage->type ?? 'N/A' }}</td>

                        {{-- Quantity --}}
                        <td>{{ $transaction->package_quantity }}</td>

                        {{-- Tickets --}}
                        <td>{{ $transaction->total_tickets }}</td>

                        {{-- Price --}}
                        <td>${{ number_format($transaction->total_price, 2) }}</td>

                        {{-- Payment status (with accessible label) --}}
                        <td>
                            @switch($transaction->payment_status)
                                @case('paid')
                                    <span class="text-success fw-bold" role="status" aria-label="Paid">Paid</span>
                                @break

                                @case('failed')
                                    <span class="text-danger fw-bold" role="status" aria-label="Failed">Failed</span>
                                @break

                                @default
                                    <span class="text-warning fw-bold" role="status" aria-label="Pending">Pending</span>
                            @endswitch
                        </td>

                        {{-- Transaction-ID with copy button --}}
                        <td class="d-flex align-items-center gap-1">
                            {{ \Illuminate\Support\Str::limit($transaction->stripe_transaction_id, 12, '…') }}
                            <button type="button" class="btn btn-link p-0"
                                aria-label="Copy full transaction ID to clipboard"
                                onclick="navigator.clipboard.writeText('{{ $transaction->stripe_transaction_id }}')">
                                <i class="fa-solid fa-clone" aria-hidden="true"></i>
                            </button>
                        </td>

                        {{-- Date --}}
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

        {{-- Pagination --}}
        <nav class="mt-3" aria-label="Transaction table pagination">
            {{ $transactions->links() }}
        </nav>
    </section>

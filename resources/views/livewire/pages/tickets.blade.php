<section class="tickets-page">
    <div class="container inner">
        <h2 class="section-title">Ticket Packages</h2>
        <div class="row g-4">
            <!-- All Packages -->
            <div class="col-lg-7 ">
                <div class="row">
                    @foreach ($Ticketpackages as $Ticketpackage)
                        <div class="col-md-6 mb-4">
                            <div class="card package-card h-100 text-center p-3">
                                <h5 class="card-title">{{ $Ticketpackage->type }}</h5>
                                <p class="card-text">Tickets: {{ $Ticketpackage->tickets }}</p>
                                <p class="card-price">${{ $Ticketpackage->price }}</p>
                                <button class="btn btn-select" wire:click="selectPackage({{ $Ticketpackage->id }})">
                                    Select Package
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card tickets-card p-4 h-100">
                    <h5 class="card-title">Selected Package</h5>

                    @if ($selectedPackage)
                        <div class="selected-package mb-3">
                            <div class="sub-title">Package Type: {{ $selectedPackage->type }}</div>
                            <div class="selected-tickets">Tickets per Package: {{ $selectedPackage->tickets }}</div>
                            <div class="selected-price">Price per Package: ${{ $selectedPackage->price }}</div>
                        </div>

                        <div class="mt-4">
                            <h6 class="sub-title">Select Quantity (Packages)</h6>
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-outline-light me-3" wire:click="decrement">-</button>
                                <div class="ticket-count">{{ $packageQuantity }}</div>
                                <button class="btn btn-outline-light ms-3" wire:click="increment">+</button>
                            </div>

                            <div class="sub-title">Total Tickets: {{ $selectedPackage->tickets * $packageQuantity }}
                            </div>
                            <div class="sub-title">Total Price: ${{ $selectedPackage->price * $packageQuantity }}</div>

                            <button class="btn btn-checkout mt-4 w-100" wire:click="checkout">
                                Checkout
                            </button>
                        </div>
                    @else
                        <p class="text-light">Please select a package to continue.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

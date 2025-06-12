<section class="tickets-page">
    <div class="container inner">
        <h2 class="section-title">Ticket Packages</h2>
        <div class="row g-4">
            <!-- All Packages -->
            <div class="col-lg-7 ">
                <div class="row">
                    @foreach ($Ticketpackages as $Ticketpackage)
                        <div class="col-md-6 mb-4">
                            <div class="card package-card h-100 text-center p-3" role="group" aria-labelledby="package-{{ $Ticketpackage->id }}">
                                <h5 class="card-title" id="package-{{ $Ticketpackage->id }}">{{ $Ticketpackage->type }}</h5>
                                <p class="card-text">Tickets: {{ $Ticketpackage->tickets }}</p>
                                <p class="card-price">${{ number_format($Ticketpackage->price, 2) }}</p>
                                <button
                                    class="btn-select"
                                    wire:click="selectPackage({{ $Ticketpackage->id }})"
                                    wire:loading.attr="disabled"
                                    title="Select {{ $Ticketpackage->type }} package"
                                    aria-label="Select {{ $Ticketpackage->type }} package">
                                    Select Package
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Selected Package -->
            <div class="col-lg-5">
                <div class="card tickets-card p-4 h-100 px-5" aria-live="polite">
                    <h5 class="card-title text-center">Selected Package</h5>

                    @if ($selectedPackage)
                        <div class="selected-package mb-3">
                            <div class="sub-title">Package Type: {{ $selectedPackage->type }}</div>
                            <div class="selected-tickets">Tickets per Package: {{ $selectedPackage->tickets }}</div>
                            <div class="selected-price">Price per Package: ${{ number_format($selectedPackage->price, 2) }}</div>
                        </div>

                        <div class="mt-4">
                            <h6 class="sub-title">Select Quantity (Packages)</h6>
                            <div class="d-flex align-items-center mb-3" role="group" aria-label="Select number of packages">
                                <button
                                    class="btn btn-outline-light me-3"
                                    wire:click="decrement"
                                    wire:loading.attr="disabled"
                                    aria-label="Decrease quantity"
                                    title="Decrease quantity">-</button>

                                <div class="ticket-count" aria-live="polite">{{ $packageQuantity }}</div>

                                <button
                                    class="btn btn-outline-light ms-3"
                                    wire:click="increment"
                                    wire:loading.attr="disabled"
                                    aria-label="Increase quantity"
                                    title="Increase quantity">+</button>
                            </div>

                            <div class="sub-title">Total Tickets: {{ $selectedPackage->tickets * $packageQuantity }}</div>
                            <div class="sub-title">Total Price: ${{ number_format($selectedPackage->price * $packageQuantity, 2) }}</div>

                            <button
                                class="btn-checkout mt-4 w-100"
                                wire:click="checkout"
                                wire:loading.attr="disabled"
                                title="Proceed to checkout"
                                aria-label="Checkout and purchase selected ticket packages">
                                Checkout
                            </button>
                        </div>
                    @else
                        <div class="d-flex align-items-center flex-column justify-content-center h-100" aria-live="polite">
                            <p class="text-light">Please select a package to continue.</p>
                            <img src="{{ asset('assets/images/Box.gif') }}" alt="Empty box illustration showing no package selected">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

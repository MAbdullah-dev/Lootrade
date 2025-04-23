<div>
    <section class="raffle-detail">
        <div class="container">
            <div class="inner d-flex align-items-center py-5">
                <!-- Image Section -->
                <div class="raffle-image col-md-5">
                    <img src="{{ Storage::url($raffle->image_path) }}" class="img-fluid rounded-4"
                        alt="{{ $raffle->title }}">
                </div>

                <!-- Raffle Details Section -->
                <div class="raffle-details col-md-7 ps-md-5">
                    <h1 class="raffle-title">{{ $raffle->title }}</h1>
                    <p class="raffle-description text-secondary">{{ $raffle->description }}</p>
                    <div class="raffle-info mt-4">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <strong>Start Date:</strong> {{ $raffle->start_date->format('M d, Y') }}
                            </div>
                            <div class="col-6 mb-3">
                                <i class="fas fa-calendar-check  me-2"></i>
                                <strong>End Date:</strong> {{ $raffle->end_date->format('M d, Y') }}
                            </div>
                            <div class="col-6 mb-3">
                                <i class="fa-solid fa-ticket me-2"></i>
                                <strong>Entry Cost:</strong> {{ $raffle->entry_cost }} Tickets
                            </div>
                            <div class="col-6 mb-3">
                                <i class="fas fa-user-plus me-2"></i>
                                <strong>Max Entries Per User:</strong> {{ $raffle->max_entries_per_user }}
                            </div>

                            <div class="col-6 mb-3">
                                <i class="fas fa-gift me-2"></i>
                                <strong>Prize:</strong> {{ $raffle->prize }} Tickets
                            </div>
                            <div class="col-6 mb-3">
                                <i class="fas fa-users me-2"></i>
                                <strong>Slots Available:</strong> {{ $raffle->slots }}
                            </div>
                        </div>
                    </div>


                    <div class="last-user-joined">
                        @if ($lastUserJoined)
                            <p><strong>Last Participant Joined:</strong> {{ $lastUserJoined->first_name }} {{ $lastUserJoined->last_name }}</p>
                        @else
                            <p><strong>No users have joined yet.</strong></p>
                        @endif
                    </div>

                    <div class="join-raffle mt-4">
                        <button class="btn-custom w-100 p-2" wire:click="openJoinModal"
                        >Join Raffle</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if ($showJoinModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div style="background-color: #222; color: #fff;" class="modal-content">
                    <div class="modal-header border-0">
                        {{-- <h5 class="modal-title">Join Raffle</h5> --}}
                        <button type="button" class="btn-close" wire:click="closeJoinModal"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="ticketsToUse" class="form-label">How many tickets?</label>
                            <input type="number" id="ticketsToUse" wire:model="joinTicketsCount" class="form-control"
                                min="{{ $raffle->entry_cost }}" max="{{ $maxTicketsAvailable }}">
                            <h6 style="font-size: 14px;" class="mt-3">
                                Minimum {{ $raffle->entry_cost }} - Maximum {{ $maxTicketsAvailable }} tickets
                            </h6>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        {{-- <button class="btn btn-secondary" wire:click="closeJoinModal">Cancel</button> --}}
                        <button class="btn-custom p-2 w-100" wire:click="confirmJoinRaffle">Confirm Join</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

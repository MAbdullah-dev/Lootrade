<div>
    <section class="raffle-detail">
        <div class="container">
            <div class="inner py-5">
                <div class="row">
                    <div class="raffle-details col-12 ps-md-5">
                        <h1 class="raffle-title">{{ $raffle->title }}</h1>
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
                                    <i class="fas fa-user-lock me-2"></i>
                                    <strong>Max Entries Per User:</strong> {{ $raffle->max_entries_per_user }}
                                </div>
                                <div class="col-6 mb-3">
                                    <i class="fas fa-user-check me-2"></i>
                                    <strong>Slots Used:</strong>
                                    @if ($uniqueUsersCount == 0)
                                        No users have joined yet.
                                    @else
                                        {{ $uniqueUsersCount }}
                                    @endif
                                </div>
                                <div class="col-12 mb-3">
                                    <i class="fas fa-users me-2"></i>
                                    <strong>Slots Available:</strong> {{ $raffle->slots }}
                                </div>
                                <div class="col-6 mb-3" wire:ignore>
                                    @if (!empty($raffle->prize))
                                        <div class="prize-wrapper">
                                            <h3>Prize</h3>
                                            <ul>
                                                @if (is_array($raffle->prize))
                                                    @foreach ($raffle->prize as $prize)
                                                        <li><strong>{{ $prize['name'] }}</strong></li>
                                                        <li><b>Description:</b> {{ $prize['description'] }}</li>
                                                        <li><b>Value:</b> {{ $prize['value'] }}</li>
                                                        <li><b>Quantity:</b> {{ $prize['quantity'] }}</li>
                                                    @endforeach
                                                @else
                                                    <p>No prizes available.</p>
                                                @endif
                                            </ul>
                                        </div>
                                    @else
                                        <p>No prizes available.</p>
                                    @endif

                                </div>
                                <div class="col-6">
                                    <h3>Description</h3>
                                    <p class="raffle-description text-secondary">{{ $raffle->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center my-5">
                    <div class="raffle-image col-md-5">
                        <img src="{{ Storage::url($raffle->image_path) }}" class="img-fluid rounded-4"
                            alt="{{ $raffle->title }}">
                    </div>
                    <div class="battle-details col-md-7 ps-md-5" wire:ignore>
                        <div class="tab-wrapper">
                            <h4 class="text-center gradient">Tower Ticket</h4>
                            <ul class="nav nav-tabs justify-content-center gap-3 my-4" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="solo-tab" data-bs-toggle="tab"
                                        data-bs-target="#tab1" type="button" role="tab" aria-controls="tab1"
                                        aria-selected="true">
                                        Solo
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="multi-tab" data-bs-toggle="tab" data-bs-target="#tab2"
                                        type="button" role="tab" aria-controls="tab2" aria-selected="false">
                                        Battle
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabsContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                                    aria-labelledby="solo-tab">
                                    <p><strong>Ticket Tower Solo: </strong>You start at the base of the Ticket Tower. At
                                        each level, you
                                        face a 50/50 choice—pick the correct ticket to earn an entry and rise to the
                                        next floor. However, a wrong choice will cost you all your entries, sending you
                                        back to the bottom.</p>

                                    <div class="d-flex justify-content-center">
                                        <button class="btn-custom px-5 py-2" wire:click="startGame('solo')">Play
                                            Solo</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="multi-tab">
                                    <p><strong>Ticket Tower Battle</strong> is an intense mini-game where members
                                        challenge a Ghit bot to
                                        claim victory and win extra entries. The goal is to be the first to collect 5
                                        tickets in the Ticket Tower. Only those who defeat the bot earn 5 bonus entries.
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn-custom px-5 py-2" wire:click="startGame('battle')">Play
                                            Battle</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <div class="frame-wrapper">
                            <video src="{{ asset('storage/' . $raffle->video_path) }}" frameborder="0"
                                controls></video>
                        </div>
                    </div>
                </div>
                <h3 class="my-4">Users</h3>
                <div class="users-wrapper">
                    @foreach ($usersJoined ?? [] as $entry)
                        <div class="user-profile text-center">
                            <div>
                                <img style="object-fit: cover"
                                    src="{{ $entry->profile_picture
                                        ? asset('storage/' . $entry->profile_picture)
                                        : asset('assets/images/dummy-profile-photo.png') }}"
                                    alt="{{ $entry->username ?? 'User' }}" alt="">
                            </div>
                            <h6>{{ $entry->username ?? 'Unknown' }}</h6>
                        </div>
                    @endforeach
                </div>
    </section>
</div>

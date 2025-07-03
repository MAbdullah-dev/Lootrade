<div>
    <section class="raffle-detail" aria-labelledby="raffle-title">
        <div class="container">
            <div class="inner py-5">
                <div class="row">
                    <div class="raffle-details col-12 ps-md-5">
                        <h1 id="raffle-title" class="raffle-title">{{ $raffle->title }}</h1>

                        <div class="raffle-info mt-4" role="region" aria-label="Raffle Information">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <i class="fas fa-calendar-alt me-2" aria-hidden="true"></i>
                                    <strong>Start Date:</strong> <time
                                        datetime="{{ $raffle->start_date }}">{{ $raffle->start_date->format('M d, Y') }}</time>
                                </div>
                                <div class="col-6 mb-3">
                                    <i class="fas fa-calendar-check me-2" aria-hidden="true"></i>
                                    <strong>End Date:</strong> <time
                                        datetime="{{ $raffle->end_date }}">{{ $raffle->end_date->format('M d, Y') }}</time>
                                </div>
                                <div class="col-6 mb-3">
                                    <i class="fas fa-user-lock me-2" aria-hidden="true"></i>
                                    <strong>Max Entries Per User:</strong> {{ $raffle->max_entries_per_user }}
                                </div>
                                <div class="col-6 mb-3">
                                    <i class="fas fa-user-check me-2" aria-hidden="true"></i>
                                    <strong>Slots Used:</strong>
                                    @if ($uniqueUsersCount == 0)
                                        No users have joined yet.
                                    @else
                                        {{ $uniqueUsersCount }}
                                    @endif
                                </div>
                                <div class="col-12 mb-3">
                                    <i class="fas fa-users me-2" aria-hidden="true"></i>
                                    <strong>Slots Available:</strong> {{ $raffle->slots }}
                                </div>

                                <div class="col-6 mb-3" wire:ignore>
                                    @if (!empty($raffle->prize))
                                        <section class="prize-wrapper" aria-label="Prize Information">
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
                                                    <li>No prizes available.</li>
                                                @endif
                                            </ul>
                                        </section>
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
                        <figure>
                            <img src="{{ Storage::url($raffle->image_path) }}" class="img-fluid rounded-4"
                                alt="Image of {{ $raffle->title }}">
                        </figure>
                    </div>

                    <div class="battle-details col-md-7 ps-md-5" wire:ignore>
                        <div class="tab-wrapper" aria-labelledby="ticket-tab-header">
                            <h4 id="ticket-tab-header" class="text-center gradient">Tower Ticket</h4>
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
                                    <p>
                                        <strong>Ticket Tower Solo:</strong> You start at the base of the Ticket Tower.
                                        At each level, you face a 50/50 choice—pick the correct ticket to earn an entry
                                        and rise to the next floor. A wrong choice will cost you all your entries,
                                        sending you back to the bottom.
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn-custom px-5 py-2" wire:click="startGame('solo')"
                                            aria-label="Play Ticket Tower Solo Mode">
                                            Play Solo
                                        </button>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="multi-tab">
                                    <p>
                                        <strong>Ticket Tower Battle:</strong> Challenge a Ghit bot to win extra entries.
                                        First to collect 5 tickets wins! Only winners receive 5 bonus entries.
                                    </p>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn-custom px-5 py-2" wire:click="startGame('battle')"
                                            aria-label="Play Ticket Tower Battle Mode">
                                            Play Battle
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($raffle->video)
                    <div class="row text-center">
                        <div class="col-12">
                            <div class="frame-wrapper" role="region" aria-label="Raffle Video">
                                <video src="{{ asset('storage/' . $raffle->video_path) }}" controls
                                    aria-label="Raffle introduction video for {{ $raffle->title }}">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($usersJoined->isnotEmpty())
                    <h3 class="my-4">Users</h3>
                    <section class="users-wrapper" aria-label="List of Users Joined">
                        @foreach ($usersJoined as $entry)
                            <article class="user-profile text-center" aria-label="User Profile">
                                <div>
                                    <img loading="lazy" style="object-fit: cover"
                                        src="{{ $entry->profile_picture
                                            ? asset('storage/' . $entry->profile_picture)
                                            : asset('assets/images/dummy-profile-photo.png') }}"
                                        alt="{{ $entry->username ? "{$entry->username}'s profile picture" : 'Default user profile image' }}">
                                </div>
                                <h6>{{ $entry->username ?? 'Unknown' }}</h6>
                            </article>
                        @endforeach
                    </section>
                @endif

            </div>
        </div>
    </section>
</div>

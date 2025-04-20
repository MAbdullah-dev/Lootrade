<div>
    <section class="raffles">
        <div class="container">
            <div class="inner">
                <div class="raffle-filter">
                    <ul class="nav nav-tabs gap-2 border-0 my-4 justify-content-end" id="raffleTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill" id="active-tab" data-bs-toggle="tab"
                                data-bs-target="#active" type="button" role="tab" aria-controls="active"
                                aria-selected="true">Active</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="upcoming-tab" data-bs-toggle="tab"
                                data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming"
                                aria-selected="false">Upcoming</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="past-tab" data-bs-toggle="tab"
                                data-bs-target="#past" type="button" role="tab" aria-controls="past"
                                aria-selected="false">Past</button>
                        </li>
                    </ul>
                </div>

                <!-- Inner Content: Raffle Cards -->
                <div class="tab-content mt-5" id="raffleTabContent">

                    <!-- Active Raffles -->
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                        <div class="row">
                            @forelse ($activeRaffles as $raffle)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                    <div class="card raffle-card">
                                        <img src="{{ Storage::url($raffle->image_path) }}" class="card-img-top"
                                            alt="Raffle Image">

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $raffle->title }}</h5>

                                            <p class="raffle-description mb-4">
                                                {{ Str::limit($raffle->description, 100) }}</p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <p class="card-text"><small class="text-muted">Start:
                                                        {{ $raffle->start_date->format('Y-m-d') }}</small></p>
                                                <p class="card-text"><small class="text-muted">End:
                                                        {{ $raffle->end_date->format('Y-m-d') }}</small></p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-user"></i> :
                                                    {{ $raffle->entries_count ?? 0 }}
                                                </small>
                                            </p>
                                            <a href="#" class="btn-custom mt-3">View More</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No active raffles found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Upcoming Raffles -->
                    <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                        <div class="row">
                            @forelse ($upcomingRaffles as $raffle)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                    <div class="card raffle-card">
                                        <img src="{{ Storage::url($raffle->image_path) }}" class="card-img-top"
                                            alt="Raffle Image">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $raffle->title }}</h5>

                                            <p class="raffle-description mb-4">
                                                {{ Str::limit($raffle->description, 100) }}</p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <p class="card-text"><small class="text-muted">Start:
                                                        {{ $raffle->start_date->format('Y-m-d') }}</small></p>
                                                <p class="card-text"><small class="text-muted">End:
                                                        {{ $raffle->end_date->format('Y-m-d') }}</small></p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-user"></i> :
                                                    {{ $raffle->entries_count ?? 0 }}
                                                </small>
                                            </p>
                                            <a href="#" class="btn-custom mt-3">View More</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No upcoming raffles found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Past Raffles -->
                    <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                        <div class="row">
                            @forelse ($pastRaffles as $raffle)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                    <div class="card raffle-card">
                                        <img src="{{ $raffle->image_url ?? 'https://via.placeholder.com/400x300' }}"
                                            class="card-img-top" alt="Raffle Image">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $raffle->title }}</h5>

                                            <p class="raffle-description mb-4">
                                                {{ Str::limit($raffle->description, 100) }}</p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <p class="card-text"><small class="text-muted">Start:
                                                        {{ $raffle->start_date->format('Y-m-d') }}</small></p>
                                                <p class="card-text"><small class="text-muted">End:
                                                        {{ $raffle->end_date->format('Y-m-d') }}</small></p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-user"></i> :
                                                    {{ $raffle->entries_count ?? 0 }}
                                                </small>
                                            </p>
                                            <a href="#" class="btn-custom mt-3">View More</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No past raffles found.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

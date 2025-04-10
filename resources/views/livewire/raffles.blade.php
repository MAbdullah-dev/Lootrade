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
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                <div class="card raffle-card">
                                    <img src="https://smallbizclub.com/wp-content/uploads/2016/12/Tips-to-Create-a-Successful-Business-Raffle.jpg"
                                        class="card-img-top" alt="Raffle Image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">Dōtonbori Canal Raffle</h5>
                                        <p class="raffle-type">Solo</p>
                                        <p class="raffle-description mb-4">Is a manmade waterway dug in the
                                            early 1600's and now displays many landmark commercial locals and vivid neon
                                            signs</p>
                                        <div class="d-flex align-items-center justify-content-center gap-3">
                                            <p class="card-text"><small class="text-muted">Start: 2025-04-01</small></p>
                                            <p class="card-text"><small class="text-muted">End: 2025-04-15</small></p>
                                        </div>

                                        <p class="card-text"><small class="text-muted"><i class="fa-solid fa-user"></i>
                                                :
                                                50</small></p>
                                        <a href="#" class="btn btn-custom mt-3">View More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Raffles -->
                    <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab">
                        <div class="row">
                            <h1>Upcoming Raffles</h1>
                        </div>
                    </div>

                    <!-- Past Raffles -->
                    <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                        <div class="row">
                            <h1>Past Raffles</h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

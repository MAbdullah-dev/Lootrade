<div>
    <section class="hero" aria-label="Current Raffle Section">
        <div class="inner my-5">
            <div class="container">
                <div class="current-raffle d-flex flex-column justify-content-center align-items-center"
                    style="background-image: url('{{ asset('assets/images/dummy-current-raffle.jpg') }}');" role="region"
                    aria-label="Current Raffle Banner">
                    <div class="overlay" aria-hidden="true"></div>
                    <div class="hero-raffle-content text-center text-white">
                        <h2 class="display-6 mb-3">Current Raffle</h2>
                        <p class="h3 mb-4" aria-live="polite" aria-label="Countdown Timer">00:00:00</p>
                        <a href="#" class="btn-custom" role="button"
                            aria-label="Enter the current raffle now">Enter Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-raffles" aria-labelledby="featuredRafflesHeading">
        <div class="inner my-5">
            <div class="container">
                <h2 id="featuredRafflesHeading" class="text-center mb-5">Featured Raffles</h2>
                <div class="swiper featuredRaffleSwiper" aria-label="Featured raffles carousel">
                    <div class="swiper-wrapper">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="swiper-slide" role="group" aria-label="Featured raffle {{ $i + 1 }}">
                                <div class="raffle-card position-relative overflow-hidden rounded">
                                    <img src="{{ asset('assets/images/card-raffle.jpg') }}"
                                        class="w-100 h-100 object-fit-cover"
                                        alt="Spin & Win Raffle Image {{ $i + 1 }}">
                                    <div
                                        class="raffle-info d-flex flex-column justify-content-center align-items-center text-white text-center gap-2">
                                        <h3 class="fw-bold">Spin & Win</h3>
                                        <p class="mb-0">Solo or Multiplayer</p>
                                        <button class="btn-custom" aria-label="View details for Spin & Win raffle">View
                                            Raffle</button>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-pagination mt-5" aria-hidden="true"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works-section" aria-labelledby="howItWorksHeading">
        <div class="how-it-works-inner">
            <div class="container text-center">
                <h2 id="howItWorksHeading" class="section-title">How it Works</h2>

                <div class="row justify-content-center" role="list">
                    <div class="col-12 text-center col-md-4" role="listitem">
                        <div class="step-item">
                            <div class="step-icon rounded-circle mx-auto" aria-hidden="true">1</div>
                            <h3 class="step-title">Step 1</h3>
                            <p class="step-description text-secondary">Choose a raffle that you like</p>
                        </div>
                    </div>

                    <div class="col-12 text-center col-md-4" role="listitem">
                        <div class="step-item">
                            <div class="step-icon rounded-circle mx-auto" aria-hidden="true">2</div>
                            <h3 class="step-title">Step 2</h3>
                            <p class="step-description text-secondary">Buy your ticket before it sells out</p>
                        </div>
                    </div>

                    <div class="col-12 text-center col-md-4" role="listitem">
                        <div class="step-item">
                            <div class="step-icon rounded-circle mx-auto" aria-hidden="true">3</div>
                            <h3 class="step-title">Step 3</h3>
                            <p class="step-description text-secondary">Wait for the draw and get notified</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function loadSwiperIfNeeded(callback) {
        if (typeof Swiper === 'undefined') {
            const script = document.createElement('script');
            script.src = "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js";
            script.onload = callback;
            document.head.appendChild(script);
        } else {
            callback();
        }
    }

    function initializeSwiper() {
        if (window.featuredRaffleSwiper instanceof Swiper) {
            window.featuredRaffleSwiper.destroy();
        }

        window.featuredRaffleSwiper = new Swiper('.featuredRaffleSwiper', {
            slidesPerView: 3,
            spaceBetween: 20,
            loop: true,
            grabCursor: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                }
            }
        });
    }

    function runSwiper() {
        loadSwiperIfNeeded(initializeSwiper);
    }

    document.addEventListener('livewire:load', runSwiper);
    document.addEventListener('livewire:navigated', runSwiper);
    document.addEventListener('DOMContentLoaded', runSwiper);
</script>

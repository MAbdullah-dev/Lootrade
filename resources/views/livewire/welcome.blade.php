<div>
    <section class="banner">
        <div class="inner">
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="cover-image">
                        <img src="{{ asset('assets/images/ghit-login-cover.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="login-options pt-5 d-flex flex-column align-items-center  justify-content-center gap-4">
                        <h2 class="fs-5 fw-semibold text-center">Sign In / Sign Up</h2>
                        <p class="text-left fs-6">Log in or sign up using your most active platform to ensure you
                            receive our winner's email.</p>
                        <div class="option-btns w-100 d-flex flex-column align-items-center px-4">
                            <button wire:click="redirectToLogin" class="login-btn google-btn w-100">
                                <img src="{{ asset('assets/svg/email-1-svgrepo-com.svg') }}" alt="">Continue
                                with Email
                            </button>
                            <button wire:click="redirectToTwitterLogin" class="X-btn login-btn w-100">
                                <img src="{{ asset('assets/svg/x-white.svg') }}" alt="">Continue with X
                            </button>
                            <button wire:click="redirectToGoogleLogin" class="google-btn login-btn w-100">
                                <img src="{{ asset('assets/svg/google.svg') }}" alt="">Continue with Google
                            </button>

                            <button wire:click="redirectToDiscordLogin" class="discord-btn login-btn w-100">
                                <img src="{{ asset('assets/svg/discord-white.svg') }}" alt="">Continue with
                                Discord
                            </button>
                        </div>
                        <p class="text-center px-3">By continuing, you accept our <a class="text-red"
                                href="/terms-and-conditions">Terms of Condition</a>. For our Privacy Policy, <a
                                class="text-red" href="/privacy-policy">click here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="intro-section">
        <div class="container">
            <div class="inner position-relative">
                <div class="row">
                    <div class="col">
                        <h2 class="opacity-75 text-uppercase fs-5 fs-md-5 mb-2 mb-md-4">
                            YOUR TICKETS, YOUR TRIBE
                        </h2>
                        <p class="fw-bold fs-3 fs-md-3 mb-4 mb-md-5 mt-5">
                            Ghitloot is where you connect, celebrate, and win together. As an active member of your
                            favorite creator’s
                            or brand’s community, you collect tickets to join exciting giveaways. Dive into the fun and
                            feel rewarded
                            as a true part of the community.
                        </p>
                        <p class="fs-6 fs-md-4 mt-4">
                            Our platform allows communities to create and manage their own giveaways, designed to
                            celebrate success and
                            reward loyalty to their followers and offer exciting giveaways without requiring any
                            purchase.
                        </p>
                    </div>
                </div>
                <!-- Image -->
                <img class="bg-img position-absolute translate-middle-x img-fluid"
                    src="{{ asset('assets/images/ghitloot-boxed-gray.png') }}" alt="Ghitloot Boxed Image">
            </div>
        </div>
    </section>
    <section class="commitment-section">
        <div class="container">
            <div class="inner">
                <h6 class="text-uppercase text-muted fs-5">GHITLOOT CODE OF ETHICS</h6>
                <h2 class="mt-4 mb-4">Our Commitment</h2>
                <p class="mt-4">At Ghitloot, we are committed to providing a fair, transparent, and enjoyable
                    experience
                    for all our
                    users. Our Code of Ethics guides our actions and decisions, ensuring we maintain the highest
                    standards
                    of integrity in all our operations.</p>
                <button class="btn-custom mt-3">Code of Ethics</button>
                <div class="row mt-5">
                    <div class="col-md-2 col-6 icon-box">
                        <img src="{{ asset('assets/svg/fair-play.svg') }}" alt="Fair Play">
                        <p>Fair Play</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box">
                        <img src="{{ asset('assets/svg/Total-Transparency.svg') }}" alt="Total Transparency">
                        <p>Total Transparency</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box">
                        <img src="{{ asset('assets/svg/User-Privacy.svg') }}" alt="User Privacy">
                        <p>User Privacy</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box">
                        <img src="{{ asset('assets/svg/CustomerSupport.svg') }}" alt="Customer Support">
                        <p>Customer Support</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box">
                        <img src="{{ asset('assets/svg/Continuous-Improvement.svg') }}" alt="Continuous Improvement">
                        <p>Continuous Improvement</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box">
                        <img src="{{ asset('assets/svg/Legal-Compliance.svg') }}" alt="Legal Compliance">
                        <p>Legal Compliance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gamification-section">
        <div class="container">
            <div class="inner">
                <div class="row gy-5 justify-content-center">
                    <div class="col-md-6">
                        <h6 class="text-uppercase  mb-5">GAMIFICATION</h6>
                        <h2 class="mt-4 mb-4"><strong>All our giveaways let you play fun and simple mini-games to earn
                                entries</strong></h2>
                        <p class="fs-5">In Ticket Tower, you start at the bottom and choose between two tickets on
                            each
                            floor. Pick
                            correctly to earn an entry and climb higher—fail, and you lose all entries and start over.
                        </p>
                        <button class="btn-custom mt-3">Tell me more</button>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="game-box">
                            <img src="{{ asset('assets/images/game-image.jpg') }}" alt="Game Preview">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="community-section">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col">
                        <h6 class="text-uppercase text-muted fs-5">CELEBRATE, AND WIN TOGETHER</h6>
                        <h2 class="mt-5"><strong>Ready to Bring Your Community to Ghitloot?</strong></h2>
                        <p class="mt-5">If you're a community leader or brand looking to engage your tribe with
                            exciting
                            giveaways and
                            interactive experiences, Ghitloot is the perfect platform for you. Connect with us today to
                            learn how we can help you reward and celebrate your community in a fun and impactful way.
                        </p>
                        <button class="btn-custom mt-3">Contact with Us</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

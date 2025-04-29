<div>
    <section class="banner">
        <div class="inner">
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="cover-image">
                        <img src="{{ asset('assets/images/ghit-login-cover.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 p-0 social-login-main">
                    <div class="login-options pt-5 d-flex flex-column align-items-center  justify-content-center gap-4">
                        <h2 class="fs-5 fw-semibold text-center gradient">Unlock the Portal to Wealth!</h2>
                        <p class="text-left fs-6 text-center">Sign in now with your favored platform—the treasure vaults
                            of EOAS
                            awaits, and the right ticket will change your destiny forever!.</p>
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
                        <h2 class="opacity-75 text-uppercase fs-5 fs-md-5 mb-2 mb-md-4 gradient">
                            TICKETS ARE YOUR KEY
                        </h2>
                        <p class="fw-bold fs-3 fs-md-3 mb-4 mb-md-5 mt-5">
                            Loot Raiders is where loyalty earns real rewards.
                            Join our community, collect tickets, and enter powerful giveaways — no purchase needed, only
                            true allegiance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="commitment-section">
        <div class="container">
            <div class="inner">
                <h2 class="text-uppercase fs-4 gradient">LOOT RAIDERS CODE OF HONOR</h2>
                <h2 class="mt-4 mb-4">Our Oath</h2>
                <p class="mt-4">At Ghitloot, we are committed to providing a fair, transparent, and enjoyable
                    At Loot Raiders, we are bound to fairness, clarity, and respect. Our Code of Ethics ensures.
                    fairplay, equal chances and wins to all users. Benefit from real world reward for your time and
                    dedication.</p>
                <div class="row mt-5 justify-content-center">
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
                </div>
            </div>
        </div>
    </section>
    <section class="gamification-section">
        <div class="container">
            <div class="inner">
                <div class="row gy-5 justify-content-center align-items-center">
                    <div class="col-md-6">
                        <h2 class="text-uppercase  mb-5 gradient">GAMIFICATION — YOUR CHOICE, YOUR REWARD</h2>
                        {{-- <h2 class="mt-4 mb-4"><strong>All our giveaways let you play fun and simple mini-games to earn
                                entries</strong></h2> --}}
                        <p class="fs-5">IAt Loot Raiders, gamification isn't just for fun — it's your strategic
                            weapon.
                            Use Ticket Tower to risk your tickets for the chance to multiply your entries.
                            Climb higher with each correct choice — or fall and lose what you've staked.
                            Prefer safety? You can always add your tickets directly into the prize pool.

                        </p>
                        <p>The choice is yours.</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="game-box">
                            <img src="{{ asset('assets/images/gamefy_image-removebg-preview.png') }}"
                                alt="Game Preview">
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
                        <h2 class="text-uppercase fs-4 gradient">EARN REAlL WORLD REWARDS, SIMPLY BY
                            DEDICATING YOUR
                            TIME
                        </h2>
                        <h6 class="mt-5">At Loot Raiders, loyalty isn’t just recognized — it’s rewarded.
                            Join forces with EOAS and unlock access to monthly prize pools worth up to $5,000.
                            Earn entries simply by investing your time, loyalty, and engagement — and stand a chance to
                            win iPhones, iPads, Bitcoin, gaming laptops, and much more. No purchase. No cost, Just pure
                            opportunity.
                        </h6>
                        <p>Build the next generation gaming future with us,let the victories begin.</p>
                        <button class="btn-custom mt-3" onclick="window.location.href='mailto:join@ghitloot.com'">
                            Join us
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="newsletter-section">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col text-center">
                        <h2 class="text-uppercase fs-5">RAIDERS INTEL — DIRECT TO YOUR EMAIL</h2>
                        <p class="mt-4">
                            In Loot Raiders, knowledge is power.
                            Join our Newsletter and get frontline updates on new giveaways, prize pools, and community
                            quests — all delivered straight to your inbox.
                            Be ready before the rest
                        </p>
                        <form wire:submit.prevent="subscribe">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" wire:model="email" id="email" class="form-control"
                                    placeholder="Enter your email">

                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn-custom mt-3">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div role="main">
    <section class="banner" aria-label="Login Section">
        <div class="inner">
            <div class="row">
                <div class="col-md-6 p-0">
                    <div class="cover-image">
                        <img src="{{ asset('assets/images/lootraiders-cover-photo.png') }}" alt="Loot Raiders Cover Image">
                    </div>
                </div>
                <div class="col-md-6 p-0 social-login-main">
                    <div class="login-options pt-5 d-flex flex-column align-items-center justify-content-center gap-4">
                        <h2 class="fs-5 fw-semibold text-center gradient">Unlock the Portal to Wealth!</h2>
                        <p class="fs-6 text-center">Sign in now with your favored platform—the treasure vaults
                            of EOAS await, and the right ticket will change your destiny forever!</p>

                        <div class="option-btns w-100 d-flex flex-column align-items-center px-4" role="group" aria-label="Social login options">
                            <button wire:click="redirectToLogin" class="login-btn google-btn w-100" aria-label="Continue with Email">
                                <img src="{{ asset('assets/svg/email-1-svgrepo-com.svg') }}" alt="Email Icon"> Continue with Email
                            </button>
                            <button wire:click="redirectToTwitterLogin" class="X-btn login-btn w-100" aria-label="Continue with X (Twitter)">
                                <img src="{{ asset('assets/svg/x-white.svg') }}" alt="X (Twitter) Icon"> Continue with X
                            </button>
                            <button wire:click="redirectToGoogleLogin" class="google-btn login-btn w-100" aria-label="Continue with Google">
                                <img src="{{ asset('assets/svg/google.svg') }}" alt="Google Icon"> Continue with Google
                            </button>
                            <button wire:click="redirectToDiscordLogin" class="discord-btn login-btn w-100" aria-label="Continue with Discord">
                                <img src="{{ asset('assets/svg/discord-white.svg') }}" alt="Discord Icon"> Continue with Discord
                            </button>
                        </div>

                        <p class="text-center px-3">By continuing, you accept our
                            <a class="text-red" href="/terms-and-conditions">Terms of Condition</a>. For our
                            <a class="text-red" href="/privacy-policy">Privacy Policy</a>, click here.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="intro-section" aria-labelledby="tickets-key">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col">
                        <h2 id="tickets-key" class="opacity-75 text-uppercase fs-5 mb-2 gradient">TICKETS ARE YOUR KEY</h2>
                        <p class="fw-bold fs-3 mt-4">Loot Raiders is where loyalty earns real rewards.
                            Join our community, collect tickets, and enter powerful giveaways — no purchase needed,
                            only true allegiance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="commitment-section" aria-labelledby="code-of-honor">
        <div class="container">
            <div class="inner">
                <h2 id="code-of-honor" class="text-uppercase fs-4 gradient">LOOT RAIDERS CODE OF HONOR</h2>
                <h3 class="mt-4 mb-4">Our Oath</h3>
                <p class="mt-4">At Loot Raiders, we are bound to fairness, clarity, and respect. Our Code of Ethics ensures
                    fair play, equal chances, and real-world rewards for your time and dedication.</p>

                <div class="row mt-5 justify-content-center" role="list">
                    <div class="col-md-2 col-6 icon-box" role="listitem">
                        <img src="{{ asset('assets/svg/fair-play.svg') }}" alt="Fair Play Icon">
                        <p>Fair Play</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box" role="listitem">
                        <img src="{{ asset('assets/svg/Total-Transparency.svg') }}" alt="Total Transparency Icon">
                        <p>Total Transparency</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box" role="listitem">
                        <img src="{{ asset('assets/svg/User-Privacy.svg') }}" alt="User Privacy Icon">
                        <p>User Privacy</p>
                    </div>
                    <div class="col-md-2 col-6 icon-box" role="listitem">
                        <img src="{{ asset('assets/svg/CustomerSupport.svg') }}" alt="Customer Support Icon">
                        <p>Customer Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gamification-section" aria-labelledby="gamification-heading">
        <div class="container">
            <div class="inner">
                <div class="row gy-5 justify-content-center align-items-center">
                    <div class="col-md-6">
                        <h2 id="gamification-heading" class="text-uppercase mb-5 gradient">GAMIFICATION — YOUR CHOICE, YOUR REWARD</h2>
                        <p class="fs-5">At Loot Raiders, gamification isn't just for fun — it's your strategic
                            weapon. Use Ticket Tower to risk your tickets for the chance to multiply your entries.
                            Climb higher with each correct choice — or fall and lose what you've staked.
                            Prefer safety? You can always add your tickets directly into the prize pool.
                        </p>
                        <p>The choice is yours.</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="game-box">
                            <img src="{{ asset('assets/images/gamefy_image-removebg-preview.png') }}" alt="Preview of Gamified Ticket Tower Game">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="community-section" aria-labelledby="earn-rewards">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col">
                        <h2 id="earn-rewards" class="text-uppercase fs-4 gradient">
                            EARN REAL-WORLD REWARDS, SIMPLY BY DEDICATING YOUR TIME
                        </h2>
                        <p class="mt-5">
                            At Loot Raiders, loyalty isn’t just recognized — it’s rewarded.
                            Join forces with EOAS and unlock access to monthly prize pools worth up to $5,000.
                            Earn entries simply by investing your time, loyalty, and engagement — and stand a chance to
                            win iPhones, iPads, Bitcoin, gaming laptops, and much more.
                        </p>
                        <p>No purchase. No cost. Just pure opportunity.</p>
                        <p>Build the next generation gaming future with us. Let the victories begin.</p>
                        <button class="btn-custom mt-3" onclick="window.location.href='mailto:join@ghitloot.com'" aria-label="Join us via email">
                            Join us
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter-section" aria-labelledby="newsletter-heading">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col text-center">
                        <h2 id="newsletter-heading" class="text-uppercase fs-5">RAIDERS INTEL — DIRECT TO YOUR EMAIL</h2>
                        <p class="mt-4">
                            In Loot Raiders, knowledge is power.
                            Join our newsletter and get frontline updates on new giveaways, prize pools, and community
                            quests — all delivered straight to your inbox. Be ready before the rest.
                        </p>
                        <form wire:submit.prevent="subscribe" aria-label="Newsletter Subscription Form">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" wire:model="email" id="email" class="form-control"
                                    placeholder="Enter your email" required aria-required="true">
                                @error('email')
                                    <span class="text-danger" role="alert">{{ $message }}</span>
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

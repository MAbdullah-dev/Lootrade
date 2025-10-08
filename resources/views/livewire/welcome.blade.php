<div role="main">
    <section class="banner" aria-label="Login Section">
        <div class="container-fluid p-0">
            <div class="row g-0 min-vh-100">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="position-relative h-100">
                        <img src="{{ asset('assets/images/lootraiders-cover-photo.png') }}"
                            class="w-100 h-100 object-fit-cover position-absolute" alt="Loot Raiders Cover Image">
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-center social-login-main">
                    <div class="social-login-main-content text-white px-3 py-5 py-md-8 px-md-5 w-100">
                        <h2 class="fw-bold mb-4 text-center fs-3 fs-md-2 gradient">Unlock the Portal to Wealth!</h2>
                        <p class="text-center mb-5 fs-6 fs-md-5">Sign in now with your favored platform—the treasure
                            vaults of EOAS awaits, and the right ticket will change your destiny forever!</p>
                        <div class="d-flex flex-column gap-1 mb-5">
                            <button wire:click="redirectToLogin" class="email-btn login-btn">
                                <img src="{{ asset('assets/svg/email-1-svgrepo-com.svg') }}"
                                    class="position-absolute start-0 ms-3 img-fluid" alt="Email Icon">Continue with
                                Email
                            </button>
                            <button wire:click="redirectToTwitterLogin" class="x-btn login-btn">
                                <img src="{{ asset('assets/svg/x-white.svg') }}"
                                    class="position-absolute start-0 ms-3 img-fluid" alt="X Icon">Continue with X
                            </button>
                            {{-- <button wire:click="redirectToTwitchLogin" class="twitch-btn login-btn">
                            <img src="{{ asset('assets/svg/twitch.svg') }}" class="position-absolute start-0 ms-3 img-fluid" alt="Twitch Icon">Continue with Twitch
                        </button> --}}
                            <button wire:click="redirectToDiscordLogin" class="discord-btn login-btn"
                                aria-label="Continue with Discord">
                                <img src="{{ asset('assets/svg/discord-white.svg') }}"
                                    class="position-absolute start-0 ms-3 img-fluid" alt="Discord Icon">Continue with
                                Discord
                            </button>
                            <button wire:click="redirectToGoogleLogin" class="google-btn login-btn">
                                <img src="{{ asset('assets/svg/google.svg') }}"
                                    class="position-absolute start-0 ms-3 img-fluid" alt="Google Icon">Continue with
                                Google
                            </button>
                            {{-- <button wire:click="redirectToKickLogin" class="kick-btn login-btn">
                                <img src="{{ asset('assets/svg/kick.svg') }}"
                                    class="position-absolute start-0 ms-3 img-fluid" alt="Kick Icon">Continue with Kick
                            </button> --}}
                        </div>
                        <p class="text-center fs-6">By continuing, you accept our <a
                                class="gradient text-decoration-none hover-underline"
                                href="{{ route('terms.conditions') }}" wire:navigate>Terms
                                of Condition</a>. For our <a class="gradient text-decoration-none hover-underline"
                                href="{{ route('privacy.policy') }} " wire:navigate>Privacy Policy</a>, click here.</p>
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
                        <h2 id="tickets-key" class="opacity-75 text-uppercase fs-5 mb-2 gradient">TICKETS ARE YOUR KEY
                        </h2>
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
                <p class="mt-4">At Loot Raiders, we are bound to fairness, clarity, and respect. Our Code of Ethics
                    ensures
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
                        <h2 id="gamification-heading" class="text-uppercase mb-5 gradient">GAMIFICATION — YOUR CHOICE,
                            YOUR REWARD</h2>
                        <p class="fs-5">At Loot Raiders, gamification isn't just for fun — it's your strategic
                            weapon. Use Ticket Tower to risk your tickets for the chance to multiply your entries.
                            Climb higher with each correct choice — or fall and lose what you've staked.
                            Prefer safety? You can always add your tickets directly into the prize pool.
                        </p>
                        <p>The choice is yours.</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="game-box">
                            <img src="{{ asset('assets/images/gamefy_image-removebg-preview.png') }}"
                                alt="Preview of Gamified Ticket Tower Game">
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
                        <button class="btn-custom mt-3" onclick="window.location.href='jan.elementsofasoul@gmail.com'"
                            aria-label="Join us via email">
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
                        <h2 id="newsletter-heading" class="text-uppercase fs-5">RAIDERS INTEL — DIRECT TO YOUR EMAIL
                        </h2>
                        <p class="mt-4">
                            In Loot Raiders, knowledge is power
                            Join our newsletter and get frontline updates on new giveaways - prize pools, and community
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
    <div id="container">
        <div class="preloader .preloader_main">
            <div id="loader">
                <!--?xml version="1.0" encoding="UTF-8"?-->
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 500 145.2" style="enable-background:new 0 0 500 145.2;" xml:space="preserve" width="500" height="145.1999969482422">
<style type="text/css">
	.st0{fill:#477FC1;stroke:#000000;stroke-miterlimit:10;}
	.st1{fill:url(#SVGID_1_);stroke:#000000;stroke-miterlimit:10;}
	.st2{fill:url(#SVGID_00000129898271602817932060000007047166644649842108_);stroke:#000000;stroke-miterlimit:10;}
	.st3{fill:url(#SVGID_00000012437393213907795170000003981368566409853863_);stroke:#000000;stroke-miterlimit:10;}
	.st4{fill:url(#SVGID_00000155112747575422030280000001489759966877168313_);stroke:#000000;stroke-miterlimit:10;}
	.st5{fill:url(#SVGID_00000161624084076486338920000009785633234119370413_);stroke:#000000;stroke-miterlimit:10;}
	.st6{fill:url(#SVGID_00000160182051149215011330000010457566386095369109_);stroke:#000000;stroke-miterlimit:10;}
	.st7{fill:url(#SVGID_00000160156045534497624480000003571595091664478127_);stroke:#000000;stroke-miterlimit:10;}
	.st8{fill:url(#SVGID_00000045607344220977523560000015577427194621896380_);stroke:#000000;stroke-miterlimit:10;}
	.st9{fill:url(#SVGID_00000025440291157113910680000015472130762895409335_);stroke:#000000;stroke-miterlimit:10;}
	.st10{fill:url(#SVGID_00000155841709523800403260000003301056626225831322_);stroke:#000000;stroke-miterlimit:10;}
	.st11{fill:url(#SVGID_00000128445314865799065010000000041373649792758192_);stroke:#000000;stroke-miterlimit:10;}
	.st12{fill:url(#SVGID_00000144324698129720494840000016875477752097122217_);stroke:#000000;stroke-miterlimit:10;}
	.st13{fill:url(#SVGID_00000060747647806566002610000011544724230564240768_);stroke:#000000;stroke-miterlimit:10;}
	.st14{fill:url(#SVGID_00000016780919658573576080000006821192057595617420_);stroke:#000000;stroke-miterlimit:10;}
	.st15{fill:url(#SVGID_00000007415692899978465440000013773006653326392756_);stroke:#000000;stroke-miterlimit:10;}
	.st16{fill:url(#SVGID_00000101068636525582731140000012189833232797901736_);stroke:#000000;stroke-miterlimit:10;}
	.st17{fill:url(#SVGID_00000002358013868917911570000010097012213554172547_);stroke:#000000;stroke-miterlimit:10;}
	.st18{fill:url(#SVGID_00000032641695185568418920000005297318335792673687_);stroke:#000000;stroke-miterlimit:10;}
	.st19{fill:url(#SVGID_00000082333681479505511660000003169704173244105632_);stroke:#000000;stroke-miterlimit:10;}
	.st20{fill:url(#SVGID_00000180337700174346981630000012093891479238929295_);stroke:#000000;stroke-miterlimit:10;}
	.st21{fill:url(#SVGID_00000075130123772339314830000002741511790514078897_);stroke:#000000;stroke-miterlimit:10;}
	.st22{fill:url(#SVGID_00000101089494118850135040000009662387770717331880_);stroke:#000000;stroke-miterlimit:10;}
	.st23{fill:url(#SVGID_00000025440236363992262960000006123570658588139662_);stroke:#000000;stroke-miterlimit:10;}
	.st24{fill:url(#SVGID_00000116946712127990034450000002232086025608385411_);stroke:#000000;stroke-miterlimit:10;}
	.st25{fill:url(#SVGID_00000064316080919758988640000015050426137003383981_);stroke:#000000;stroke-miterlimit:10;}
	.st26{fill:url(#SVGID_00000038383175342867575850000016496615529201500304_);stroke:#000000;stroke-miterlimit:10;}
	.st27{fill:url(#SVGID_00000067197540540633614290000003301490239164356795_);stroke:#000000;stroke-miterlimit:10;}
	.st28{fill:url(#SVGID_00000179617352350027494970000013371795945471007887_);stroke:#000000;stroke-miterlimit:10;}
	.st29{fill:url(#SVGID_00000084489149328156808620000015660353958028680886_);stroke:#000000;stroke-miterlimit:10;}
	.st30{fill:url(#SVGID_00000036968701989637822830000018228571093091432345_);stroke:#000000;stroke-miterlimit:10;}
	.st31{fill:#3D0F44;stroke:#000000;stroke-miterlimit:10;}
	.st32{fill:#95509F;stroke:#FFFFFF;stroke-miterlimit:10;}
	.st33{fill:#95509F;stroke:#000000;stroke-miterlimit:10;}
</style>
<path class="st32 svg-elem-1" d="M13.4,24.46h11.14v39.07h24.14v9.08H13.4V24.46z"></path>
<path class="st32 svg-elem-2" d="M67.9,70.71c-3.09-1.63-5.51-3.89-7.26-6.77c-1.74-2.89-2.61-6.17-2.61-9.84c0-3.67,0.87-6.95,2.61-9.83
	c1.74-2.89,4.16-5.15,7.26-6.78c3.1-1.63,6.59-2.44,10.49-2.44c3.9,0,7.38,0.81,10.45,2.44c3.07,1.63,5.48,3.89,7.22,6.78
	c1.74,2.89,2.61,6.17,2.61,9.83c0,3.67-0.87,6.95-2.61,9.84c-1.74,2.89-4.15,5.15-7.22,6.77c-3.07,1.63-6.56,2.44-10.45,2.44
	C74.49,73.15,71,72.34,67.9,70.71z M85.17,61.56c1.76-1.86,2.65-4.34,2.65-7.46c0-3.12-0.88-5.61-2.65-7.46
	c-1.77-1.86-4.02-2.79-6.77-2.79s-5.02,0.93-6.81,2.79c-1.79,1.86-2.68,4.34-2.68,7.46c0,3.12,0.89,5.61,2.68,7.46
	c1.79,1.86,4.06,2.79,6.81,2.79S83.4,63.42,85.17,61.56z"></path>
<path class="st32 svg-elem-3" d="M119.83,70.71c-3.09-1.63-5.51-3.89-7.26-6.77c-1.74-2.89-2.61-6.17-2.61-9.84c0-3.67,0.87-6.95,2.61-9.83
	c1.74-2.89,4.16-5.15,7.26-6.78c3.1-1.63,6.59-2.44,10.49-2.44c3.9,0,7.38,0.81,10.45,2.44c3.07,1.63,5.48,3.89,7.22,6.78
	c1.74,2.89,2.61,6.17,2.61,9.83c0,3.67-0.87,6.95-2.61,9.84c-1.74,2.89-4.15,5.15-7.22,6.77c-3.07,1.63-6.56,2.44-10.45,2.44
	C126.42,73.15,122.93,72.34,119.83,70.71z M137.09,61.56c1.76-1.86,2.65-4.34,2.65-7.46c0-3.12-0.88-5.61-2.65-7.46
	c-1.77-1.86-4.02-2.79-6.77-2.79s-5.02,0.93-6.81,2.79c-1.79,1.86-2.68,4.34-2.68,7.46c0,3.12,0.89,5.61,2.68,7.46
	c1.79,1.86,4.06,2.79,6.81,2.79S135.33,63.42,137.09,61.56z"></path>
<path class="st32 svg-elem-4" d="M186.93,70.81c-1.05,0.78-2.35,1.36-3.89,1.75c-1.54,0.39-3.13,0.58-4.78,0.58c-4.45,0-7.86-1.12-10.25-3.37
	c-2.38-2.25-3.58-5.55-3.58-9.9V27.41h10.73v9.01h9.15v8.25h-9.15v15.06c0,1.56,0.39,2.76,1.17,3.61c0.78,0.85,1.9,1.27,3.37,1.27
	c1.65,0,3.12-0.46,4.4-1.38L186.93,70.81z"></path>
<path class="st32 svg-elem-5" d="M215.3,36.42c2.18-0.92,4.69-1.38,7.53-1.38v9.9c-1.19-0.09-2-0.14-2.41-0.14c-3.07,0-5.48,0.86-7.22,2.58
	c-1.74,1.72-2.61,4.3-2.61,7.74V72.6h-10.73v-37h10.25v4.88C211.39,38.69,213.12,37.34,215.3,36.42z"></path>
<path class="st32 svg-elem-6" d="M273.31,35.6v37h-10.25v-4.26c-2.66,3.21-6.51,4.81-11.56,4.81c-3.48,0-6.64-0.78-9.46-2.34
	c-2.82-1.56-5.03-3.78-6.64-6.67c-1.61-2.89-2.41-6.24-2.41-10.04c0-3.8,0.8-7.15,2.41-10.04c1.6-2.89,3.82-5.11,6.64-6.67
	c2.82-1.56,5.97-2.34,9.46-2.34c4.72,0,8.41,1.49,11.07,4.47V35.6H273.31z M260.11,61.56c1.79-1.86,2.68-4.34,2.68-7.46
	c0-3.12-0.89-5.61-2.68-7.46c-1.79-1.86-4.04-2.79-6.74-2.79c-2.75,0-5.02,0.93-6.81,2.79c-1.79,1.86-2.68,4.34-2.68,7.46
	c0,3.12,0.89,5.61,2.68,7.46c1.79,1.86,4.06,2.79,6.81,2.79C256.07,64.35,258.32,63.42,260.11,61.56z"></path>
<path class="st32 svg-elem-7" d="M290.64,28.72c-1.24-1.15-1.86-2.57-1.86-4.26c0-1.7,0.62-3.12,1.86-4.26c1.24-1.15,2.84-1.72,4.82-1.72
	c1.97,0,3.58,0.55,4.81,1.65c1.24,1.1,1.86,2.48,1.86,4.13c0,1.79-0.62,3.27-1.86,4.44c-1.24,1.17-2.84,1.75-4.81,1.75
	C293.49,30.44,291.88,29.87,290.64,28.72z M290.09,35.6h10.73v37h-10.73V35.6z"></path>
<path class="st32 svg-elem-8" d="M355.36,21.57V72.6h-10.25v-4.26c-2.66,3.21-6.51,4.81-11.56,4.81c-3.49,0-6.64-0.78-9.46-2.34
	c-2.82-1.56-5.03-3.78-6.64-6.67c-1.61-2.89-2.41-6.24-2.41-10.04c0-3.8,0.8-7.15,2.41-10.04c1.6-2.89,3.82-5.11,6.64-6.67
	c2.82-1.56,5.97-2.34,9.46-2.34c4.72,0,8.41,1.49,11.07,4.47V21.57H355.36z M342.16,61.56c1.79-1.86,2.68-4.34,2.68-7.46
	c0-3.12-0.89-5.61-2.68-7.46c-1.79-1.86-4.04-2.79-6.74-2.79c-2.75,0-5.02,0.93-6.81,2.79c-1.79,1.86-2.68,4.34-2.68,7.46
	c0,3.12,0.89,5.61,2.68,7.46c1.79,1.86,4.06,2.79,6.81,2.79C338.12,64.35,340.37,63.42,342.16,61.56z"></path>
<path class="st32 svg-elem-9" d="M395.91,63.69c1.49-0.57,2.88-1.48,4.16-2.72l5.71,6.19c-3.49,3.99-8.57,5.98-15.27,5.98
	c-4.17,0-7.86-0.81-11.07-2.44c-3.21-1.63-5.69-3.89-7.43-6.77c-1.74-2.89-2.61-6.17-2.61-9.84c0-3.62,0.86-6.89,2.58-9.8
	c1.72-2.91,4.08-5.18,7.08-6.81c3-1.63,6.38-2.44,10.15-2.44c3.53,0,6.74,0.75,9.63,2.24c2.89,1.49,5.19,3.65,6.91,6.47
	c1.72,2.82,2.58,6.16,2.58,10.01l-27.37,5.3c0.78,1.83,2,3.21,3.68,4.13c1.67,0.92,3.72,1.38,6.16,1.38
	C392.71,64.55,394.42,64.27,395.91,63.69z M382.6,45.78c-1.7,1.74-2.59,4.15-2.68,7.22l18.02-3.51c-0.5-1.93-1.54-3.46-3.09-4.61
	c-1.56-1.15-3.44-1.72-5.64-1.72C386.5,43.16,384.3,44.03,382.6,45.78z"></path>
<path class="st32 svg-elem-10" d="M437.86,36.42c2.18-0.92,4.69-1.38,7.53-1.38v9.9c-1.19-0.09-2-0.14-2.41-0.14c-3.07,0-5.48,0.86-7.22,2.58
	c-1.74,1.72-2.61,4.3-2.61,7.74V72.6h-10.73v-37h10.25v4.88C433.95,38.69,435.69,37.34,437.86,36.42z"></path>
<path class="st32 svg-elem-11" d="M462.25,72.02c-2.93-0.76-5.27-1.71-7.01-2.85l3.58-7.7c1.65,1.06,3.65,1.92,5.98,2.58
	c2.34,0.67,4.63,1,6.88,1c4.54,0,6.81-1.12,6.81-3.37c0-1.05-0.62-1.81-1.86-2.27c-1.24-0.46-3.14-0.85-5.71-1.17
	c-3.03-0.46-5.53-0.99-7.5-1.58c-1.97-0.59-3.68-1.65-5.12-3.16c-1.44-1.51-2.17-3.67-2.17-6.46c0-2.34,0.68-4.41,2.03-6.22
	c1.35-1.81,3.32-3.22,5.92-4.23c2.59-1.01,5.65-1.51,9.18-1.51c2.61,0,5.22,0.29,7.81,0.86c2.59,0.57,4.73,1.36,6.43,2.37
	l-3.58,7.63c-3.26-1.83-6.81-2.75-10.66-2.75c-2.29,0-4.01,0.32-5.16,0.96c-1.15,0.64-1.72,1.47-1.72,2.48
	c0,1.15,0.62,1.95,1.86,2.41s3.21,0.89,5.92,1.31c3.03,0.5,5.5,1.04,7.43,1.62s3.6,1.62,5.02,3.13c1.42,1.51,2.13,3.62,2.13,6.33
	c0,2.29-0.69,4.33-2.06,6.12c-1.38,1.79-3.38,3.18-6.02,4.16s-5.77,1.48-9.39,1.48C468.18,73.15,465.18,72.77,462.25,72.02z"></path>
<path class="st32 svg-elem-12" d="M28.09,115.97l-4.06-5.86h-0.24h-4.24v5.86h-4.87V94.93h9.11c1.86,0,3.48,0.31,4.85,0.93
	c1.37,0.62,2.43,1.5,3.17,2.65c0.74,1.14,1.11,2.5,1.11,4.06c0,1.56-0.38,2.91-1.13,4.04c-0.75,1.13-1.82,2-3.2,2.6l4.72,6.76H28.09
	z M26.86,99.85c-0.76-0.63-1.87-0.95-3.34-0.95h-3.97v7.33h3.97c1.46,0,2.57-0.32,3.34-0.96s1.14-1.54,1.14-2.71
	C28,101.38,27.62,100.48,26.86,99.85z"></path>
<path class="st32 svg-elem-13" d="M54.33,95.71c1.44,0.76,2.57,1.88,3.37,3.37c0.8,1.48,1.2,3.28,1.2,5.38v11.51h-4.87v-5.05h-9.62v5.05H39.6
	v-11.51c0-2.1,0.4-3.9,1.2-5.38s1.92-2.61,3.37-3.37c1.44-0.76,3.14-1.14,5.08-1.14C51.19,94.57,52.89,94.95,54.33,95.71z
	 M54.03,107.02v-3.01c0-1.74-0.43-3.06-1.29-3.95c-0.86-0.89-2.03-1.34-3.52-1.34c-1.5,0-2.68,0.45-3.53,1.34s-1.28,2.21-1.28,3.95
	v3.01H54.03z"></path>
<path class="st32 svg-elem-14" d="M73.93,98.84v13.23h3.64v3.91H65.39v-3.91h3.67V98.84h-3.67v-3.91h12.17v3.91H73.93z"></path>
<path class="st32 svg-elem-15" d="M84.24,94.93h9.56c2.29,0,4.3,0.44,6.06,1.31c1.75,0.87,3.12,2.1,4.09,3.68s1.46,3.43,1.46,5.53
	c0,2.1-0.49,3.95-1.46,5.53c-0.97,1.58-2.33,2.81-4.09,3.68c-1.75,0.87-3.77,1.31-6.06,1.31h-9.56V94.93z M93.56,111.98
	c2.1,0,3.78-0.59,5.04-1.76c1.25-1.17,1.88-2.76,1.88-4.76c0-2-0.63-3.59-1.88-4.76c-1.25-1.17-2.93-1.76-5.04-1.76h-4.45v13.05
	H93.56z"></path>
<path class="st32 svg-elem-16" d="M138.92,100.82c-1.8-1.04-3.74-1.71-5.8-2.01v17.16h-4.87V98.81c-2.06,0.3-4.01,0.97-5.83,2.01l-1.65-3.64
	c1.44-0.86,3.01-1.51,4.69-1.95c1.68-0.44,3.42-0.66,5.2-0.66c1.8,0,3.55,0.22,5.25,0.66s3.25,1.09,4.67,1.95L138.92,100.82z"></path>
<path class="st32 svg-elem-17" d="M152.99,98.84v13.23h3.64v3.91h-12.17v-3.91h3.67V98.84h-3.67v-3.91h12.17v3.91H152.99z"></path>
<path class="st32 svg-elem-18" d="M167.4,114.94c-1.73-0.93-3.1-2.22-4.09-3.88s-1.49-3.52-1.49-5.61c0-2.08,0.5-3.95,1.49-5.61
	s2.35-2.95,4.09-3.88s3.68-1.4,5.85-1.4c1.82,0,3.47,0.32,4.94,0.96c1.47,0.64,2.71,1.56,3.71,2.77l-3.13,2.89
	c-1.42-1.64-3.19-2.46-5.29-2.46c-1.3,0-2.46,0.29-3.49,0.86c-1.02,0.57-1.82,1.37-2.39,2.39c-0.57,1.02-0.86,2.18-0.86,3.49
	c0,1.3,0.29,2.47,0.86,3.49c0.57,1.02,1.37,1.82,2.39,2.39c1.02,0.57,2.18,0.86,3.49,0.86c2.1,0,3.87-0.83,5.29-2.5l3.13,2.89
	c-1,1.22-2.25,2.15-3.73,2.79c-1.48,0.64-3.14,0.96-4.96,0.96C171.07,116.33,169.13,115.87,167.4,114.94z"></path>
<path class="st32 svg-elem-19" d="M195.85,107.71l-2.83,2.95v5.32h-4.84V94.93h4.84v9.83l9.32-9.83h5.41l-8.72,9.38l9.23,11.66h-5.68
	L195.85,107.71z"></path>
<path class="st32 svg-elem-20" d="M230.33,114.17c-1,0.68-2.26,1.21-3.77,1.59c-1.51,0.38-3.12,0.57-4.83,0.57c-2.12,0-3.93-0.27-5.41-0.8
	c-1.48-0.53-2.61-1.27-3.37-2.22s-1.14-2.04-1.14-3.26c0-1.12,0.31-2.11,0.93-2.98c0.62-0.86,1.47-1.5,2.55-1.92
	c-0.82-0.44-1.46-1.04-1.91-1.8c-0.45-0.76-0.68-1.61-0.68-2.56c0-1.14,0.35-2.18,1.05-3.13c0.7-0.94,1.76-1.69,3.19-2.25
	c1.42-0.56,3.17-0.84,5.23-0.84c1.36,0,2.7,0.14,4,0.41s2.43,0.64,3.4,1.1l-1.35,3.73c-1.84-0.86-3.8-1.29-5.86-1.29
	c-1.56,0-2.74,0.24-3.53,0.71c-0.79,0.47-1.19,1.11-1.19,1.91c0,0.74,0.27,1.31,0.8,1.7c0.53,0.39,1.34,0.59,2.42,0.59h5.74v3.85
	h-6.04c-1.22,0-2.16,0.21-2.83,0.63c-0.66,0.42-0.99,1.03-0.99,1.83c0,0.84,0.42,1.5,1.28,1.97c0.85,0.47,2.16,0.71,3.92,0.71
	c1.24,0,2.48-0.17,3.73-0.5c1.24-0.33,2.29-0.8,3.16-1.4L230.33,114.17z"></path>
<path class="st32 svg-elem-21" d="M251.34,100.82c-1.8-1.04-3.74-1.71-5.8-2.01v17.16h-4.87V98.81c-2.06,0.3-4.01,0.97-5.83,2.01l-1.65-3.64
	c1.44-0.86,3.01-1.51,4.69-1.95c1.68-0.44,3.42-0.66,5.2-0.66c1.8,0,3.55,0.22,5.25,0.66s3.25,1.09,4.67,1.95L251.34,100.82z"></path>
<path class="st32 svg-elem-22" d="M260.29,115.66c-1.55-0.45-2.8-1.04-3.74-1.76l1.65-3.67c0.9,0.66,1.97,1.19,3.22,1.59
	c1.24,0.4,2.48,0.6,3.73,0.6c1.38,0,2.41-0.21,3.07-0.62s0.99-0.96,0.99-1.64c0-0.5-0.2-0.92-0.59-1.25c-0.39-0.33-0.89-0.6-1.5-0.8
	c-0.61-0.2-1.44-0.42-2.48-0.66c-1.6-0.38-2.92-0.76-3.94-1.14c-1.02-0.38-1.9-0.99-2.63-1.83c-0.73-0.84-1.1-1.96-1.1-3.37
	c0-1.22,0.33-2.33,0.99-3.32c0.66-0.99,1.66-1.78,2.99-2.36c1.33-0.58,2.96-0.87,4.88-0.87c1.34,0,2.66,0.16,3.94,0.48
	c1.28,0.32,2.4,0.78,3.37,1.38l-1.5,3.7c-1.94-1.1-3.89-1.65-5.83-1.65c-1.36,0-2.37,0.22-3.02,0.66c-0.65,0.44-0.98,1.02-0.98,1.74
	c0,0.72,0.38,1.26,1.13,1.61c0.75,0.35,1.9,0.7,3.44,1.04c1.6,0.38,2.92,0.76,3.94,1.14c1.02,0.38,1.9,0.98,2.63,1.8
	c0.73,0.82,1.1,1.93,1.1,3.34c0,1.2-0.34,2.3-1.01,3.29c-0.67,0.99-1.68,1.78-3.02,2.36s-2.98,0.87-4.9,0.87
	C263.45,116.33,261.84,116.11,260.29,115.66z"></path>
<path class="st32 svg-elem-23" d="M284.53,111.18c0.54,0.53,0.81,1.23,0.81,2.09c0,0.4-0.05,0.8-0.15,1.2c-0.1,0.4-0.32,1-0.66,1.8l-1.71,4.33
	h-2.98l1.32-4.78c-0.5-0.2-0.9-0.53-1.19-0.98c-0.29-0.45-0.44-0.98-0.44-1.58c0-0.86,0.28-1.56,0.83-2.09
	c0.55-0.53,1.25-0.8,2.09-0.8S283.99,110.65,284.53,111.18z"></path>
<path class="st32 svg-elem-24" d="M334.67,94.93v12.42c0,2.93-0.79,5.16-2.38,6.69c-1.58,1.53-3.83,2.3-6.73,2.3c-1.44,0-2.73-0.21-3.86-0.63
	s-2.06-1.01-2.78-1.77c-0.74,0.76-1.67,1.35-2.8,1.77s-2.39,0.63-3.82,0.63c-2.91,0-5.15-0.77-6.73-2.3
	c-1.58-1.53-2.38-3.76-2.38-6.69V94.93h4.87v12.26c0,1.7,0.35,2.96,1.05,3.77s1.74,1.22,3.13,1.22c2.83,0,4.24-1.66,4.24-4.99V94.93
	h4.87v12.26c0,3.33,1.42,4.99,4.27,4.99c2.77,0,4.15-1.66,4.15-4.99V94.93H334.67z"></path>
<path class="st32 svg-elem-25" d="M349.7,98.84v13.23h3.64v3.91h-12.17v-3.91h3.67V98.84h-3.67v-3.91h12.17v3.91H349.7z"></path>
<path class="st32 svg-elem-26" d="M377.02,96.93c1.4,1.57,2.1,3.81,2.1,6.72v12.32h-4.87V103.8c0-1.68-0.4-2.95-1.19-3.8
	c-0.79-0.85-1.89-1.28-3.29-1.28c-1.48,0-2.67,0.46-3.56,1.37s-1.34,2.26-1.34,4.04v11.84h-4.87V94.93h4.72v2.55
	c0.72-0.96,1.62-1.69,2.71-2.18s2.32-0.74,3.73-0.74C373.67,94.57,375.62,95.36,377.02,96.93z"></path>
<path class="st32 svg-elem-27" d="M416.73,106.94c0.68,0.89,1.02,1.99,1.02,3.29c0,1.84-0.72,3.26-2.15,4.25c-1.43,0.99-3.52,1.49-6.27,1.49
	h-10.88V94.93h10.28c2.57,0,4.53,0.49,5.91,1.47c1.37,0.98,2.06,2.31,2.06,4c0,1.02-0.25,1.93-0.74,2.74
	c-0.49,0.8-1.18,1.43-2.06,1.89C415.11,105.41,416.05,106.05,416.73,106.94z M403.3,98.6v4.96h4.84c1.2,0,2.11-0.21,2.74-0.63
	c0.62-0.42,0.93-1.04,0.93-1.86c0-0.82-0.31-1.44-0.93-1.85c-0.62-0.41-1.53-0.62-2.74-0.62H403.3z M411.88,111.67
	c0.65-0.42,0.98-1.07,0.98-1.95c0-1.74-1.29-2.62-3.88-2.62h-5.68v5.2h5.68C410.26,112.31,411.23,112.1,411.88,111.67z"></path>
<path class="st32 svg-elem-28" d="M431.67,98.84v13.23h3.64v3.91h-12.17v-3.91h3.67V98.84h-3.67v-3.91h12.17v3.91H431.67z"></path>
<path class="st32 svg-elem-29" d="M456.05,105.12h4.45v10.85h-3.67v-1.26c-1.46,1.08-3.35,1.62-5.65,1.62c-1.94,0-3.73-0.42-5.35-1.26
	c-1.62-0.84-2.92-2.07-3.88-3.68s-1.44-3.53-1.44-5.76c0-2.14,0.5-4.05,1.49-5.73c0.99-1.67,2.37-2.98,4.13-3.92
	c1.76-0.94,3.75-1.41,5.95-1.41c1.84,0,3.52,0.31,5.02,0.93s2.77,1.52,3.79,2.71l-3.13,2.89c-1.5-1.58-3.32-2.38-5.44-2.38
	c-1.34,0-2.54,0.29-3.58,0.86c-1.04,0.57-1.85,1.38-2.44,2.42s-0.87,2.24-0.87,3.61c0,1.42,0.29,2.64,0.86,3.64s1.34,1.76,2.3,2.27
	s2.01,0.77,3.16,0.77c1.7,0,3.14-0.48,4.3-1.44V105.12z"></path>
<path class="st32 svg-elem-30" d="M479.33,115.42c-0.55-0.53-0.83-1.18-0.83-1.94s0.27-1.4,0.81-1.91c0.54-0.51,1.23-0.77,2.07-0.77
	s1.53,0.25,2.07,0.77c0.54,0.51,0.81,1.15,0.81,1.91s-0.28,1.41-0.83,1.94c-0.55,0.53-1.24,0.8-2.06,0.8
	C480.57,116.21,479.88,115.95,479.33,115.42z M478.6,94.93h5.59l-0.93,13.74h-3.73L478.6,94.93z"></path>
</svg>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(window).on('load', function () {
        setTimeout(() => {
            $(".preloader").fadeOut('slow', function () {
                $(this).remove();
            });
        }, 4000); // ⏳ keep preloader for 1 second after load
    });
</script>
@endpush

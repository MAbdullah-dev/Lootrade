<header class="border-bottoms" role="banner">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <a href="{{ route('home') }}" class="me-3" aria-label="Go to Homepage">
                <img src="{{ asset('assets/images/new logo.png') }}" alt="Lootraiders Logo" height="40">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="d-none d-lg-block desktop-nav" role="navigation" aria-label="Main navigation">
            <ul class="nav gap-4">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" wire:navigate>Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('raffles') }}" class="nav-link" wire:navigate>Raffles</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tickets') }}" class="nav-link" wire:navigate>Tickets</a>
                </li>
            </ul>
        </nav>

        <!-- Ticket Count + Login/Profile -->
        <div class="d-flex align-items-center gap-4 header-btns">
            @if ($isNotAdmin)
                <button class="btn-custom position-relative" >
                    <i class="fa-solid fa-ticket me-1"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                        {{ $ticketCount }}
                    </span>
                </button>
            @endif

            @if (!Auth::check())
                <a href="{{ route('login') }}" class="btn-custom">Login</a>
            @endif

            <!-- Hamburger for mobile -->
            <div class="hamburger d-block d-lg-none" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <!-- User Avatar Dropdown (Desktop) -->
            @if (Auth::check())
                <div class="user-avatar dropdown d-none d-lg-block">
                    <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown"
                        aria-expanded="false" aria-haspopup="true" aria-label="User menu">
                        <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('assets/images/dummy-profile-photo.png') }}"
                             alt="User Profile Picture">
                        <i class="fa-solid fa-sort-down ms-2"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" wire:click="logout()">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div class="mobile-nav" id="mobileNav">
        <nav>
            <ul class="nav gap-4 d-flex flex-column">
                @if (Auth::check())
                    <li>
                        <div class="user-avatar dropdown">
                            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-haspopup="true" aria-label="User menu">
                                <img src="{{ Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('assets/images/dummy-profile-photo.png') }}"
                                     alt="User Profile Picture">
                                <i class="fa-solid fa-sort-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile') }}" wire:navigate>
                                        <i class="fas fa-user"></i> Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" wire:click="logout()">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" wire:navigate>Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('raffles') }}" class="nav-link" wire:navigate>Raffles</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tickets') }}" class="nav-link" wire:navigate>Tickets</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hamburger = document.getElementById('hamburger');
        const mobileNav = document.getElementById('mobileNav');

        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('open');
            mobileNav.classList.toggle('show');

            // // Update ARIA state
            // const isExpanded = hamburger.getAttribute('aria-expanded') === 'true';
            // hamburger.setAttribute('aria-expanded', !isExpanded);
        });
    });
</script>
@endpush

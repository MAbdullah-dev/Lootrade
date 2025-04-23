{{-- @vite(['resources/css/app.css']) --}}
<header class="border-bottoms">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <a href="#" class="me-3">
                <img src="{{ asset('assets/svg/ghit-beta-logo.svg') }}" alt="Logo" height="40">
            </a>
        </div>

        <!-- Navigation -->
        <nav class="d-none d-lg-block desktop-nav">
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

        <!-- Ticket Count + Login -->
        <div class="d-flex align-items-center gap-3 header-btns gap-4">
            <button class="btn-custom position-relative">
                <i class="fa-solid fa-ticket me-1"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $ticketCount }}
                </span>
            </button>
            @if (!Auth::check())
                <a href="{{ route('login') }}" class="btn-custom">Login</a>
            @endif
            <div class="hamburger d-block d-lg-none" id="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            @if (Auth::check())
                <div class="user-avatar dropdown d-none d-lg-block">
                    <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::check() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('assets/images/dummy-profile-photo.png') }}"
                            alt="Profile">

                        <i class="fa-solid fa-sort-down ms-2"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile') }}" wire:navigate><i
                                    class="fas fa-user"></i>
                                Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" wire:click="logout()"><i class="fas fa-sign-out-alt"></i>
                                Logout</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="mobile-nav" id="mobileNav">
        <nav>
            <ul class="nav gap-4 d-flex flex-column">
                <li>
                    @if (Auth::check())
                        <div class="user-avatar dropdown">
                            <a href="#" class="d-flex align-items-center" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ Auth::check() && Auth::user()->profile_picture ? Storage::url(Auth::user()->profile_picture) : asset('assets/images/dummy-profile-photo.png') }}"
                                    alt="Profile">

                                <i class="fa-solid fa-sort-down ms-2"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                {{-- <li><a class="dropdown-item" href=""><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li> --}}
                                <li><a class="dropdown-item" href="{{ route('profile') }}" wire:navigate><i
                                            class="fas fa-user"></i>
                                        Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" wire:click="logout()"><i class="fas fa-sign-out-alt"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                    @endif
                </li>
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
        $(document).ready(function() {
            $('#hamburger').on('click', function() {
                $(this).toggleClass('open');
                $('#mobileNav').toggleClass('show');
            });
        });
    </script>
@endpush

<header class="border-bottoms">
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="#" class="me-3">
                <img src="{{ asset('assets/svg/ghit-beta-logo.svg') }}" alt="Logo" height="40">
            </a>

            <div class="left-menu d-flex">
                <!-- Ticket Count + Login (before toggler) -->
                <div class="d-flex align-items-center gap-3 header-btns">
                    <button class="btn-custom position-relative">
                        <i class="fa-solid fa-ticket me-1"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <a href="{{ route('login') }}" class="btn-custom">Login</a>
                </div>
                <!-- Toggler -->
                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
                <ul class="navbar-nav">
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
            </div>

        </div>
    </nav>
</header>

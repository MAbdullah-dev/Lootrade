<header class="border-bottoms">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <div class="d-flex align-items-center">
            <a href="#" class="me-3">
                <img src="assets/svg/ghit-beta-logo.svg" alt="Logo" height="40">
            </a>
        </div>

        <!-- Navigation -->
        <nav>
            <ul class="nav">
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
        <div class="d-flex align-items-center gap-3 header-btns">
            <button class="btn-custom position-relative">
                <i class="fa-solid fa-ticket me-1"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </button>

            <a href="#" class="btn-custom">Login</a>
        </div>
    </div>
</header>

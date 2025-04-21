<aside>
    <div class="sidebar">
        <div class="nav d-flex flex-column">
            <ul>
                <li class="nav-item">
                    <a class=" align-items-center {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('profile') }}" wire:navigate>
                        <i class="fas fa-user"></i> <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" align-items-center {{ Route::currentRouteName() == 'myTickets' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('myTickets') }}" wire:navigate>
                        <i class="fas fa-ticket-alt"></i> <span>My Tickets</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" align-items-center {{ Route::currentRouteName() == 'support' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('support') }}" wire:navigate>
                        <i class="fas fa-headset"></i> <span>Support</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class=" align-items-center" wire:click="logout()">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
@push('js')
    <script>
        function toggleMenu(el) {
            el.classList.toggle('active');
            // Optional: also toggle menu visibility
            // document.getElementById('menu').classList.toggle('show');
        }
    </script>
@endpush

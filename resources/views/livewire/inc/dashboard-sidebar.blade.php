<aside>
    <div class="sidebar">
        <nav class="nav d-flex flex-column" role="navigation" aria-label="User Sidebar Navigation">
            <ul>
                <li class="nav-item">
                    <a class="align-items-center side-nav-icons {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                        href="{{ route('profile') }}"
                        wire:navigate
                        aria-label="Go to Profile"
                        @if(Route::currentRouteName() == 'profile') aria-current="page" @endif>
                        <i class="fas fa-user" aria-hidden="true"></i> <span>Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="align-items-center side-nav-icons {{ Route::currentRouteName() == 'myTickets' ? 'active' : '' }}"
                        href="{{ route('myTickets') }}"
                        wire:navigate
                        aria-label="Go to My Tickets"
                        @if(Route::currentRouteName() == 'myTickets') aria-current="page" @endif>
                        <i class="fas fa-ticket-alt" aria-hidden="true"></i> <span>My Tickets</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="align-items-center side-nav-icons {{ Route::currentRouteName() == 'support' ? 'active' : '' }}"
                        href="{{ route('support') }}"
                        wire:navigate
                        aria-label="Go to Support"
                        @if(Route::currentRouteName() == 'support') aria-current="page" @endif>
                        <i class="fas fa-headset" aria-hidden="true"></i> <span>Support</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'user.raffles' ? 'active' : '' }}"
                        href="{{ route('user.raffles') }}"
                        wire:navigate
                        aria-label="Go to Raffles"
                        @if(Route::currentRouteName() == 'user.raffles') aria-current="page" @endif>
                        <i class="fas fa-gift" aria-hidden="true"></i> <span>Raffles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'user.transactions' ? 'active' : '' }}"
                        href="{{ route('user.transactions') }}"
                        wire:navigate
                        aria-label="Go to Transactions"
                        @if(Route::currentRouteName() == 'user.transactions') aria-current="page" @endif>
                        <i class="fas fa-exchange-alt" aria-hidden="true"></i> <span>Transaction</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'user.change.password' ? 'active' : '' }}"
                        href="{{ route('user.change.password') }}"
                        wire:navigate
                        aria-label="Go to Reset Password"
                        @if(Route::currentRouteName() == 'user.change.password') aria-current="page" @endif>
                        <i class="fa-solid fa-unlock" aria-hidden="true"></i> <span>Reset Password</span>
                    </a>
                </li>
                <li class="nav-item" style="cursor: pointer">
                    <a class="align-items-center side-nav-icons"
                        wire:click="logout()"
                        role="button"
                        tabindex="0"
                        aria-label="Logout from your account">
                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
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

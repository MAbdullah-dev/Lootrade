<aside>
    <div class="sidebar">
        <div class="nav d-flex flex-column">
            <ul>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.raffles' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.raffles') }}" wire:navigate>
                        <i class="fas fa-gift"></i> <span>Raffles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.users') }}" wire:navigate>
                        <i class="fas fa-users"></i> <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.winners' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.winners') }}" wire:navigate>
                        <i class="fas fa-trophy"></i> <span>Winner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.transactions' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.transaction') }}" wire:navigate>
                        <i class="fas fa-exchange-alt"></i> <span>Transaction</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.ticketsPackeges' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.ticketsPackeges') }}" wire:navigate>
                        <i class="fa-solid fa-box"></i> <span>Ticket packages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.packageTypes' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.packageTypes') }}" wire:navigate>
                        <i class="fa-solid fa-box"></i> <span>Ticket packages type</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.newsletter' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.newsletter') }}" wire:navigate>
                        <i class="fa-solid fa-envelope"></i> <span>News Letter subscribers</span>
                    </a>
                </li>
                <li style="cursor: pointer" class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons" wire:click="logout()">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

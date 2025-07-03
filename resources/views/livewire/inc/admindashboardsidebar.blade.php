<aside>
    <div class="sidebar">
        <nav class="nav d-flex flex-column" role="navigation" aria-label="Admin Sidebar Navigation">
            <ul>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}"
                        aria-label="Go to Dashboard"
                        @if(Route::currentRouteName() == 'admin.dashboard') aria-current="page" @endif>
                        <i class="fas fa-tachometer-alt" aria-hidden="true"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.raffles' ? 'active' : '' }}"
                        href="{{ route('admin.raffles') }}" wire:navigate aria-label="Go to Raffles"
                        @if (Route::currentRouteName() == 'admin.raffles') aria-current="page" @endif>
                        <i class="fas fa-gift" aria-hidden="true"></i> <span>Raffles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}"
                        href="{{ route('admin.users') }}" wire:navigate aria-label="Go to Users"
                        @if (Route::currentRouteName() == 'admin.users') aria-current="page" @endif>
                        <i class="fas fa-users" aria-hidden="true"></i> <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.winners' ? 'active' : '' }}"
                        href="{{ route('admin.winners') }}" wire:navigate aria-label="Go to Winners"
                        @if (Route::currentRouteName() == 'admin.winners') aria-current="page" @endif>
                        <i class="fas fa-trophy" aria-hidden="true"></i> <span>Winner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.transaction' ? 'active' : '' }}"
                        href="{{ route('admin.transaction') }}" wire:navigate aria-label="Go to Transactions"
                        @if (Route::currentRouteName() == 'admin.transaction') aria-current="page" @endif>
                        <i class="fas fa-exchange-alt" aria-hidden="true"></i> <span>Transaction</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.ticketsPackeges' ? 'active' : '' }}"
                        href="{{ route('admin.ticketsPackeges') }}" wire:navigate aria-label="Go to Ticket Packages"
                        @if (Route::currentRouteName() == 'admin.ticketsPackeges') aria-current="page" @endif>
                        <i class="fa-solid fa-box" aria-hidden="true"></i> <span>Ticket packages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.packageTypes' ? 'active' : '' }}"
                        href="{{ route('admin.packageTypes') }}" wire:navigate aria-label="Go to Ticket Packages Type"
                        @if (Route::currentRouteName() == 'admin.packageTypes') aria-current="page" @endif>
                        <i class="fa-solid fa-box" aria-hidden="true"></i> <span>Ticket packages type</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.newsletter' ? 'active' : '' }}"
                        href="{{ route('admin.newsletter') }}" wire:navigate aria-label="Go to Newsletter Subscribers"
                        @if (Route::currentRouteName() == 'admin.newsletter') aria-current="page" @endif>
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i> <span>News Letter subscribers</span>
                    </a>
                </li>
                @if (Auth::user()->role_id == 3)
                    <li style="cursor: pointer" class="nav-item">
                        <a class="d-flex align-items-center side-nav-icons {{ Route::currentRouteName() == 'admin.logs' ? 'active' : '' }}"
                            aria-current="page" wire:click=exportLogs>
                            <i class="fa-solid fa-hexagon-nodes"></i> <span>Admin Logs</span>
                        </a>
                    </li>
                @endif
                <li style="cursor: pointer" class="nav-item">
                    <a class="d-flex align-items-center side-nav-icons" wire:click="logout()">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

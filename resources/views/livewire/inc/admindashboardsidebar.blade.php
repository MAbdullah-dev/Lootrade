<aside>
    <div class="sidebar">
        <div class="nav d-flex flex-column">
            <ul>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.dashboard') }}" wire:navigate>
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'admin.raffles' ? 'active' : '' }}"
                        aria-current="page" href="{{route('admin.raffles')}}" wire:navigate>
                        <i class="fas fa-ticket-alt"></i> Raffles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'users' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.users') }}" wire:navigate>
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'admin.winners' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('admin.winners') }}" wire:navigate>
                        <i class="fas fa-trophy"></i> Winner
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'transactions' ? 'active' : '' }}"
                        aria-current="page" href="" wire:navigate>
                        <i class="fas fa-exchange-alt"></i> Transaction
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'analytics' ? 'active' : '' }}"
                        aria-current="page" href="" wire:navigate>
                        <i class="fas fa-chart-line"></i> Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

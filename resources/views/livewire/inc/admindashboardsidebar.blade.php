<aside>
    <div class="sidebar">
        <div class="nav d-flex flex-column">
            <ul>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('profile') }}" wire:navigate>
                        <i class="fas fa-user"></i> Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'myTickets' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('myTickets') }}" wire:navigate>
                        <i class="fas fa-ticket-alt"></i> My Tickets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'support' ? 'active' : '' }}"
                        aria-current="page" href="{{ route('support') }}" wire:navigate>
                        <i class="fas fa-headset"></i> Support
                    </a>
                </li>
                <!-- Additional menu items can be added here -->
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'settings' ? 'active' : '' }}"
                        aria-current="page" href="" wire:navigate>
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center {{ Route::currentRouteName() == 'logout' ? 'active' : '' }}"
                        aria-current="page" href="" wire:navigate>
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>

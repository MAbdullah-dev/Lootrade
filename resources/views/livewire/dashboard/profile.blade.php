<div class="profile" role="region" aria-labelledby="profile-heading">
    <div class="form-wrapper mx-auto">
        <h2 id="profile-heading" class="mb-5 gradient">Profile Form</h2>

        <ol class="d-flex align-items-center text-center gap-4 mb-4" aria-label="Ticket Earning Tips">
            <li class="gradient"><span>Login every day to receive a ticket.</span></li>
            <li class="gradient"><span>Complete your profile to earn 10 tickets.</span></li>
            <li class="gradient"><span>Connect a social account to earn 10 tickets.</span></li>
        </ol>

        <form wire:submit.prevent="save" aria-describedby="profile-description">
            <p id="profile-description" class="visually-hidden">Fill out your profile to continue.</p>

            <!-- First Name -->
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="first-name" class="form-label">First Name</label>
                    <input type="text" id="first-name" class="form-control" wire:model="first_name"
                        placeholder="Enter first name" aria-describedby="{{ $errors->has('first_name') ? 'first-name-error' : '' }}">
                    @error('first_name')
                        <span id="first-name-error" class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <label for="last-name" class="form-label">Last Name</label>
                    <input type="text" id="last-name" class="form-control" wire:model="last_name"
                        placeholder="Enter last name" aria-describedby="{{ $errors->has('last_name') ? 'last-name-error' : '' }}">
                    @error('last_name')
                        <span id="last-name-error" class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Username and DOB -->
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" wire:model="username"
                        placeholder="Enter username" aria-describedby="{{ $errors->has('username') ? 'username-error' : '' }}">
                    @error('username')
                        <span id="username-error" class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" id="dob" class="form-control" wire:model="date_of_birth"
                        aria-describedby="{{ $errors->has('date_of_birth') ? 'dob-error' : '' }}">
                    @error('date_of_birth')
                        <span id="dob-error" class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Profile Picture Upload -->
            <div class="row mb-4">
                <div class="col-12">
                    <label for="profile-image" class="form-label">Profile Picture</label>
                    <input type="file" id="profile-image" wire:model="profile_picture" aria-describedby="profile-image-desc">
                    <span id="profile-image-desc" class="visually-hidden">Choose a picture to represent your profile</span>

                    <div class="custom-file-label d-flex align-items-center justify-content-between mt-2">
                        <div>
                            <i class="fas fa-upload"></i>
                            <span id="file-name">Choose file</span>
                        </div>

                        @if ($profile_picture)
                            <img src="{{ $profile_picture->temporaryUrl() }}" alt="New profile picture preview" width="100">
                        @elseif ($existing_profile_picture)
                            <img src="{{ Storage::url($existing_profile_picture) }}" alt="Current profile picture" width="100">
                        @endif
                    </div>

                    @error('profile_picture')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div wire:loading wire:target="profile_picture" class="mt-2" aria-live="polite">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 100%">
                                Uploading...
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn-custom" aria-label="Save profile changes">Save</button>
            </div>
        </form>
    </div>

    <!-- Social Connect Buttons -->
    <div class="divider mt-5" role="separator"><span>Connect</span></div>

    <div class="social-login" role="group" aria-label="Connect social accounts">
        <button wire:click="redirectToGoogleLogin" type="button"
            class="social-btn google {{ in_array('google', $connected_providers) ? 'connected' : 'gradient' }}"
            {{ in_array('google', $connected_providers) ? 'disabled' : '' }}
            aria-label="Connect Google account" aria-disabled="{{ in_array('google', $connected_providers) ? 'true' : 'false' }}">
            <i class="fab fa-google"></i>
        </button>

        <button wire:click="redirectToTwitterLogin" type="button"
            class="social-btn x {{ in_array('twitter', $connected_providers) ? 'connected' : 'gradient' }}"
            {{ in_array('twitter', $connected_providers) ? 'disabled' : '' }}
            aria-label="Connect Twitter account" aria-disabled="{{ in_array('twitter', $connected_providers) ? 'true' : 'false' }}">
            <i class="fab fa-x-twitter"></i>
        </button>

        <button wire:click="redirectToDiscordLogin" type="button"
            class="social-btn discord {{ in_array('discord', $connected_providers) ? 'connected' : 'gradient' }}"
            {{ in_array('discord', $connected_providers) ? 'disabled' : '' }}
            aria-label="Connect Discord account" aria-disabled="{{ in_array('discord', $connected_providers) ? 'true' : 'false' }}">
            <i class="fab fa-discord"></i>
        </button>
    </div>

    <!-- Notification Bell -->
    <div class="notification-bell position-fixed d-flex align-items-center justify-content-center"
        data-bs-toggle="offcanvas" data-bs-target="#notificationCanvas" aria-controls="notificationCanvas"
        role="button" tabindex="0" aria-label="Open notifications panel">
        <i class="fa-solid fa-bell gradient"></i>
        @if ($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" aria-label="{{ $unreadCount }} unread notifications">
                {{ $unreadCount }}
            </span>
        @endif
    </div>

    <!-- Notifications Panel -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationCanvas"
        aria-labelledby="notificationCanvasLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title gradient" id="notificationCanvasLabel">Notifications</h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close notification panel"></button>
        </div>
        <div class="offcanvas-body">
            @forelse ($notifications as $notification)
                <div class="notification-card p-3 mb-3 rounded-4 shadow-sm d-flex flex-column"
                    wire:key="notification-{{ $notification->id }}">
                    <p class="mb-1 text-white">{{ $notification->message }}</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <small class="text-secondary">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>
                        <button class="btn btn-danger btn-sm mt-2"
                            wire:click="deleteNotification({{ $notification->id }})" aria-label="Delete notification">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            @empty
                <p>No notifications yet.</p>
            @endforelse
        </div>
    </div>
</div>

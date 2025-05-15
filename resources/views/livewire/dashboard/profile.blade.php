<div class="profile">
    <div class="form-wrapper mx-auto">
        <h5 class="mb-5 gradient">Profile Form</h5>
        <ol class="d-flex align-items-center text-center gap-4 mb-4 ">
            <li><span>Login everyday to receive a ticket each day.</span></li>
            <li><span>Complete the profile to receive 10 tickets.</span></li>
            <li><span>Connect Social Account to receive 10 tickets.</span></li>
        </ol>
        <form wire:submit="save">
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="first-name" class="form-label">First name</label>
                    <input type="text" class="form-control" id="first-name" wire:model="first_name"
                        placeholder="Enter first name" />
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="last-name" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="last-name" wire:model="last_name"
                        placeholder="Enter last name" />
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" wire:model="username"
                        placeholder="Enter username" />
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input class="form-control flatpickr-input" id="dob" wire:model="date_of_birth"
                        placeholder="Select date" type="date" />
                    @error('date_of_birth')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label">Profile Picture</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="profile-image" wire:model="profile_picture" />
                        <div class="custom-file-label d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-upload"></i>
                                <span id="file-name">Choose file</span>
                            </div>
                            @if ($profile_picture)
                                <div class="mt-2">
                                    <img src="{{ $profile_picture->temporaryUrl() }}" alt="Profile Picture"
                                        width="100" />
                                </div>
                            @elseif ($existing_profile_picture)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($existing_profile_picture) }}" alt="Profile Picture"
                                        width="100" />
                                </div>
                            @endif

                        </div>

                    </div>
                    @error('profile_picture')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div wire:loading wire:target="profile_picture" class="mt-2">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 100%">Uploading...</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn-custom">Save</button>
            </div>
        </form>
    </div>
    <div class="divider">
        <span>Connect</span>
    </div>

    <div class="social-login">
        <button wire:click="redirectToGoogleLogin" type="button"
            class="social-btn google {{ in_array('google', $connected_providers) ? 'connected' : 'gradient' }}"
            {{ in_array('google', $connected_providers) ? 'disabled' : '' }}>
            <i class="fab fa-google"></i>
        </button>

        <button wire:click="redirectToTwitterLogin" type="button"
            class="social-btn x {{ in_array('twitter', $connected_providers) ? 'connected' : ' gradient' }}"
            {{ in_array('twitter', $connected_providers) ? 'disabled' : '' }}>
            <i class="fab fa-x-twitter"></i>
        </button>

        <button wire:click="redirectToDiscordLogin" type="button"
            class="social-btn discord {{ in_array('discord', $connected_providers) ? 'connected' : ' gradient' }}"
            {{ in_array('discord', $connected_providers) ? 'disabled' : '' }}>
            <i class="fab fa-discord"></i>
        </button>
    </div>
    <div class="notification-bell position-fixed d-flex align-items-center justify-content-center"
        data-bs-toggle="offcanvas" data-bs-target="#notificationCanvas" aria-controls="notificationCanvas">
        <i class="fa-solid fa-bell gradient"></i>
        @if ($unreadCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill">
                {{ $unreadCount }}
            </span>
        @endif
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="notificationCanvas"
        aria-labelledby="notificationCanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title gradient" id="notificationCanvasLabel">Notifications</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @foreach ($notifications as $notification)
                <div class="notification-card p-3 mb-3 rounded-4 shadow-sm d-flex flex-column"
                    wire:key="notification-{{ $notification->id }}>
                <p class="mb-1 text-white">
                    {{ $notification->message }}
                    </p>
                    <div class="d-flex align-items-center justify-content-between">
                        <small class="text-secondary">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>
                        <button class="btn btn-danger btn-sm mt-2"
                            wire:click="deleteNotification({{ $notification->id }})"><i
                                class="fa fa-trash"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('js')
    <script>
        // Update file input label
        document.querySelector('#profile-image').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Choose file';
            document.querySelector('#file-name').textContent = fileName;
        });
    </script>
@endpush

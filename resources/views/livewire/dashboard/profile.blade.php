<div class="profile">


    <div class="form-wrapper mx-auto">
        <h5 class="mb-4">Profile Form</h5>
        <ol class="d-flex align-items-center">
            <li><span class="text-secondary">Login everyday to receive 1 ticket each day.</span></li>
            <li><span class="text-secondary">Complete the profile to receive 10 tickets.</span></li>
            <li><span class="text-secondary">Connect Social Account to receive 10 tickets.</span></li>
        </ol>
        <form wire:submit.prevent="save">
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
                        placeholder="Select date" />
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
                        <div class="custom-file-label">
                            <i class="fas fa-upload"></i>
                            <span id="file-name">Choose file</span>
                        </div>
                    </div>
                    @if ($existing_profile_picture)
                        <div class="mt-2">
                            <img src="{{ Storage::url($existing_profile_picture) }}" alt="Profile Picture"
                                width="100" />
                        </div>
                    @endif
                    @error('profile_picture')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn-custom">Save</button>
            </div>
        </form>
    </div>

    <section class="social-logins">
        <div class="inner">
            <div class="option-btns w-100 d-flex flex-column align-items-center">
                <button class="google-btn login-btn w-100"
                    {{ in_array('google', $connected_providers) ? 'disabled' : '' }}>
                    <img src="{{ asset('assets/svg/google.svg') }}" alt="">Connect with Google
                </button>
                <button class="X-btn login-btn w-100" {{ in_array('x', $connected_providers) ? 'disabled' : '' }}>
                    <img src="{{ asset('assets/svg/x-white.svg') }}" alt="">Connect with X
                </button>
                <button class="discord-btn login-btn w-100"
                    {{ in_array('discord', $connected_providers) ? 'disabled' : '' }}>
                    <img src="{{ asset('assets/svg/discord-white.svg') }}" alt="">Connect with Discord
                </button>
            </div>
        </div>
    </section>
</div>

@push('js')
    <script>
        $("#dob").flatpickr({
            dateFormat: "Y-m-d",
            maxDate: "today",
            defaultDate: @json($date_of_birth),
            minDate: "1900-01-01",
            enableTime: false,
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true,
            clickOpens: true,
            disableMobile: false,
            onChange: function(selectedDates, dateStr) {
                @this.set('date_of_birth', dateStr);
            }
        });

        // Update file input label
        document.querySelector('#profile-image').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Choose file';
            document.querySelector('#file-name').textContent = fileName;
        });
    </script>
@endpush

<div class="profile">


    <div class="form-wrapper mx-auto">
        <h5 class="mb-5">Profile Form</h5>
        <ol class="d-flex align-items-center text-center gap-4 mb-4 ">
            <li><span class="text-secondary">Login everyday to receive a ticket each day.</span></li>
            <li><span class="text-secondary">Complete the profile to receive 10 tickets.</span></li>
            <li><span class="text-secondary">Connect Social Account to receive 10 tickets.</span></li>
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
            class="social-btn google {{ in_array('google', $connected_providers) ? 'connected' : '' }}"
            {{ in_array('google', $connected_providers) ? 'disabled' : '' }}>
            <i class="fab fa-google"></i>
        </button>

        <button wire:click="redirectToTwitterLogin" type="button"
            class="social-btn x {{ in_array('twitter', $connected_providers) ? 'connected' : '' }}"
            {{ in_array('twitter', $connected_providers) ? 'disabled' : '' }}>
            <i class="fab fa-x-twitter"></i>
        </button>

        <button wire:click="redirectToDiscordLogin" type="button"
            class="social-btn discord {{ in_array('discord', $connected_providers) ? 'connected' : '' }}"
            {{ in_array('discord', $connected_providers) ? 'disabled' : '' }}>
            <i class="fab fa-discord"></i>
        </button>
    </div>

</div>

@push('js')
    <script>
        // function initFlatpickr() {
        //     $("#dob").flatpickr({
        //         dateFormat: "Y-m-d",
        //         maxDate: "today",
        //         defaultDate: @json($date_of_birth),
        //         minDate: "1900-01-01",
        //         enableTime: false,
        //         altInput: true,
        //         altFormat: "F j, Y",
        //         allowInput: true,
        //         clickOpens: true,
        //         disableMobile: false,
        //         onChange: function(selectedDates, dateStr) {
        //             @this.set('date_of_birth', dateStr);
        //         }
        //     });
        // }

        // document.addEventListener('livewire:load', function() {
        //     console.log("livewire loaded")
        //     initFlatpickr();
        // });

        // Livewire.hook('message.processed', (message, component) => {
        //     initFlatpickr();
        // });

        // Update file input label
        document.querySelector('#profile-image').addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Choose file';
            document.querySelector('#file-name').textContent = fileName;
        });
    </script>
@endpush

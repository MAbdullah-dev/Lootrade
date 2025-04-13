<div class="profile">
    <div class="form-wrapper mx-auto">
        <h5 class="mb-4">Profile Form</h5>
        <form>
            <!-- Row 1: First Name and Last Name -->
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="first-name" class="form-label">First name</label>
                    <input type="text" class="form-control" id="first-name" placeholder="Enter first name" />
                </div>
                <div class="col-md-6">
                    <label for="last-name" class="form-label">Last name</label>
                    <input type="text" class="form-control" id="last-name" placeholder="Enter last name" />
                </div>
            </div>

            <!-- Row 2: Username and Date of Birth -->
            <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" />
                </div>
                <div class="col-md-6">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input class="form-control flatpickr-input" id="dob" placeholder="Select date" />
                </div>
            </div>

            <!-- Row 3: Custom Image (Full Width) -->
            <div class="row mb-4">
                <div class="col-12">
                    <label class="form-label">Custom Image adding Input</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="profile-image" />
                        <div class="custom-file-label">
                            <i class="fas fa-upload"></i>
                            <span id="file-name">Choose file</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn-custom">Save</button>
            </div>

            <!-- Connect with Section -->
        </form>
    </div>
    <section class="social-logins">
        <div class="inner">
            <div class="option-btns w-100 d-flex flex-column align-items-center">
                <button class="google-btn login-btn w-100">
                    <img src="{{ asset('assets/svg/google.svg') }}" alt="">Continue with Google
                </button>
                <button class="X-btn login-btn w-100">
                    <img src="{{ asset('assets/svg/x-white.svg') }}" alt="">Continue with X
                </button>
                <button class="discord-btn login-btn w-100">
                    <img src="{{ asset('assets/svg/discord-white.svg') }}" alt="">Continue with
                    Discord
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
            defaultDate: null,
            minDate: "1900-01-01",
            enableTime: false,
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true,
            clickOpens: true,
            disableMobile: false
        });
    </script>
@endpush

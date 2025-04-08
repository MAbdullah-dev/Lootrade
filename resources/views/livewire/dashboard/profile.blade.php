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
                    <input type="date" class="form-control" id="dob" />
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
            <div class="connect-with mt-4">
                <h6 class="connect-title">Connect with</h6>
                <div class="social-login">
                    <button class="social-btn google">
                        <i class="fab fa-google"></i>
                    </button>
                    <button class="social-btn x">
                        <i class="fab fa-x-twitter"></i>
                    </button>
                    <button class="social-btn discord">
                        <i class="fab fa-discord"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

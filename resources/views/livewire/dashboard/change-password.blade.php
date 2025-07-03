<section class="change-password mt-3" aria-labelledby="resetPasswordHeading">
    <div class="row">
        <div class="col-md-6">
            <form wire:submit="changePassword" aria-describedby="passwordFormInstructions">
                <p id="passwordFormInstructions" class="visually-hidden">
                    Enter your current password, new password, and confirm it to update your password.
                </p>

                <div class="mb-3">
                    <label for="current_password" class="form-label text-white">Current Password</label>
                    <input
                        type="password"
                        id="current_password"
                        wire:model="current_password"
                        class="form-control @error('current_password') is-invalid @enderror"
                        placeholder="Enter current password"
                        aria-required="true"
                        aria-invalid="{{ $errors->has('current_password') ? 'true' : 'false' }}"
                        @error('current_password') aria-describedby="currentPasswordError" @enderror
                    >
                    @error('current_password')
                        <div id="currentPasswordError" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label text-white">New Password</label>
                    <input
                        type="password"
                        id="new_password"
                        wire:model="new_password"
                        class="form-control @error('new_password') is-invalid @enderror"
                        placeholder="Enter new password"
                        aria-required="true"
                        aria-invalid="{{ $errors->has('new_password') ? 'true' : 'false' }}"
                        @error('new_password') aria-describedby="newPasswordError" @enderror
                    >
                    @error('new_password')
                        <div id="newPasswordError" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label text-white">Confirm New Password</label>
                    <input
                        type="password"
                        id="confirm_password"
                        wire:model="confirm_password"
                        class="form-control @error('confirm_password') is-invalid @enderror"
                        placeholder="Confirm new password"
                        aria-required="true"
                        aria-invalid="{{ $errors->has('confirm_password') ? 'true' : 'false' }}"
                        @error('confirm_password') aria-describedby="confirmPasswordError" @enderror
                    >
                    @error('confirm_password')
                        <div id="confirmPasswordError" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn-custom" aria-label="Update your password">
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

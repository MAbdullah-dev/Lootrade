<div class="change-password">
    <div class="row">
        <div class="col-md-6">
            <form wire:submit="changePassword">

                <div class="mb-3">
                    <label for="current_password" class="form-label text-white">Current Password</label>
                    <input type="password" id="current_password" wire:model="current_password"
                        class="form-control @error('current_password') is-invalid @enderror"
                        placeholder="Enter current password">
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label text-white">New Password</label>
                    <input type="password" id="new_password" wire:model="new_password"
                        class="form-control @error('new_password') is-invalid @enderror"
                        placeholder="Enter new password">
                    @error('new_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label text-white">Confirm New Password</label>
                    <input type="password" id="confirm_password" wire:model="confirm_password"
                        class="form-control @error('confirm_password') is-invalid @enderror"
                        placeholder="Confirm new password">
                    @error('confirm_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn-custom">
                        Update Password
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


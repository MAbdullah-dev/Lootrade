<div class="reset-password">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 93vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form wire:submit.prevent="resetPassword">
                            @csrf

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input type="password" id="password" class="form-control" wire:model="password" required>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input type="password" id="password_confirmation" class="form-control" wire:model="password_confirmation" required>
                            </div>

                            <div class="mb-3 text-end">
                                <button type="submit" class="btn-custom">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="reset-password">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 93vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form wire:submit.prevent="resetPassword" >
                            @csrf

                            <div class="mb-3">
                                <label for="password" class="form-label text-white">{{ __('Password') }}</label>
                                <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Enter new password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label text-white">{{ __('Confirm Password') }}</label>
                                <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control" required placeholder="Confirm new password">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn-custom">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

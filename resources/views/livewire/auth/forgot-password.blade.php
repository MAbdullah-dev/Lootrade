<div>
    <div wire:ignore.self
         class="modal fade"
         id="forgotPasswordModal"
         tabindex="-1"
         aria-labelledby="forgotPasswordModalLabel"
         aria-describedby="forgotPasswordModalDesc"
         aria-hidden="true"
         role="dialog"
         aria-modal="true">

        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="sendResetLink" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <p id="forgotPasswordModalDesc" class="visually-hidden">
                        Enter your email to receive a password reset link.
                    </p>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            wire:click="resetForm">
                    </button>
                </div>

                <div class="modal-body">
                    @if ($successMessage)
                        <div class="alert alert-success" role="alert" aria-live="polite">
                            {{ $successMessage }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                               wire:model.defer="email"
                               class="form-control @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               placeholder="Enter your email"
                               required
                               autocomplete="email"
                               aria-required="true">
                        @error('email')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            wire:click="resetForm"
                            aria-label="Cancel and close modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn-custom">
                        Send Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    window.addEventListener('close-modal', () => {
        $('#forgotPasswordModal').modal('hide');
    });
</script>
@endpush

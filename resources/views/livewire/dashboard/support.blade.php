<section class="support-section" aria-labelledby="support-ticket-heading">
    <div class="inner">
        <div class="form-wrapper mx-auto">
            <h2 id="support-ticket-heading" class="text-center mb-4 gradient">Support Ticket</h2>

            <form class="mx-auto" wire:submit.prevent="submit" aria-describedby="form-description">
                <p id="form-description" class="visually-hidden">
                    Fill out the subject and description to submit a support ticket.
                </p>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input
                        type="text"
                        id="subject"
                        class="form-control"
                        wire:model.defer="subject"
                        placeholder="Enter subject"
                        aria-describedby="{{ $errors->has('subject') ? 'subject-error' : '' }}"
                    >
                    @error('subject')
                        <small id="subject-error" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                        id="description"
                        class="form-control"
                        rows="5"
                        wire:model.defer="description"
                        placeholder="Describe your issue..."
                        aria-describedby="{{ $errors->has('description') ? 'description-error' : '' }}"
                    ></textarea>
                    @error('description')
                        <small id="description-error" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn-custom w-100" aria-label="Submit Support Ticket">Submit Ticket</button>
            </form>
        </div>
    </div>
</section>

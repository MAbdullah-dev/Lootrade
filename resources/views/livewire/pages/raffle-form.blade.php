<div class="raffle-form-page">

    <header role="banner">
        <div class="container-fluid">
            <div class="inner">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <img src="{{ asset('assets/images/new logo.png') }}" alt="Company Logo" height="40">
                    </div>
                    <div>
                        <a href="#" aria-label="Close form" role="button">
                            <i class="px-2 fa-solid fa-xmark fs-3" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="raffle-form-section" role="region" aria-labelledby="raffleFormHeading">
        <div class="container">
            <div class="inner d-flex align-items-center flex-column justify-content-center py-5">
                <h2 id="raffleFormHeading">Raffle Form</h2>
                <form wire:submit.prevent="save" role="form" aria-describedby="formHelp">
                    <div class="form-wrapper">
                        <div class="form-inner">
                            <div class="raffle-form">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Title" wire:model="title" aria-describedby="titleError">
                                    @error('title')
                                        <small class="text-danger" id="titleError">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" placeholder="Description" name="description" class="form-control" wire:model="description" aria-describedby="descriptionError"></textarea>
                                    @error('description')
                                        <small class="text-danger" id="descriptionError">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="max_entries_per_user" class="form-label">Maximum Entries Per User</label>
                                    <input type="number" class="form-control" id="max_entries_per_user" placeholder="Max Entries" wire:model="max_entries_per_user" aria-describedby="maxEntriesError">
                                    @error('max_entries_per_user')
                                        <small class="text-danger" id="maxEntriesError">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="date-range mb-3">
                                    <div wire:ignore>
                                        <label for="raffle_date_range" class="form-label">Start Date & End Date</label>
                                        <input id="raffle_date_range" class="form-control" placeholder="Start Date & End Date" aria-describedby="dateError">
                                    </div>
                                    @error('start_date')
                                        <small class="text-danger" id="dateError">{{ $message }}</small>
                                    @enderror
                                    @error('end_date')
                                        <small class="text-danger" id="dateError">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="slots" class="form-label">Slots (Max Players)</label>
                                    <input type="number" id="slots" class="form-control" placeholder="Enter slots" wire:model="slots" aria-describedby="slotsError">
                                    @error('slots')
                                        <small class="text-danger" id="slotsError">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="imageInput" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" id="imageInput" accept="image/*" wire:model="image" aria-describedby="imageError">
                                    @error('image')
                                        <small class="text-danger" id="imageError">{{ $message }}</small>
                                    @enderror
                                    <div id="imagePreview" class="mt-3" style="display: none;" wire:ignore aria-live="polite">
                                        <div class="spinner-border text-primary" id="imageLoader" role="status" aria-label="Loading image preview"></div>
                                        <div class="d-flex justify-content-center">
                                            <img id="previewImage" src="" class="img-fluid mt-2 rounded shadow" style="max-width: 300px; display: none;" alt="Preview of selected image" />
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="videoInput" class="form-label">Upload Video (Optional)</label>
                                    <input type="file" class="form-control" id="videoInput" accept="video/*" wire:model="video" aria-describedby="videoError">
                                    @error('video')
                                        <small class="text-danger" id="videoError">{{ $message }}</small>
                                    @enderror
                                    <div id="videoPreview" class="mt-3" style="display: none;" wire:ignore aria-live="polite">
                                        <div class="spinner-border text-success" id="videoLoader" role="status" aria-label="Loading video preview"></div>
                                        <div class="d-flex justify-content-center">
                                            <video id="previewVideo" class="mt-2 rounded shadow" style="width: 100%; max-width: 500px; height: 280px; display: none;" controls aria-label="Preview of selected video"></video>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="price-form">
                                <h3 class="mb-5 mt-3 text-center">Prize Info</h3>
                                <div class="form-group prize p-3 mb-3 rounded">
                                    <div class="mb-3">
                                        <label for="prize_name" class="mb-2">Prize Name</label>
                                        <input type="text" class="form-control" id="prize_name" wire:model="prizes.0.name" aria-describedby="prizeNameError">
                                        @error('prizes.0.name')
                                            <small class="text-danger" id="prizeNameError">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="prize_description" class="mb-2">Prize Description</label>
                                        <textarea id="prize_description" class="form-control" wire:model="prizes.0.description" aria-describedby="prizeDescError"></textarea>
                                        @error('prizes.0.description')
                                            <small class="text-danger" id="prizeDescError">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="prize_value" class="mb-2">Prize Value (Optional)</label>
                                        <input type="number" id="prize_value" class="form-control" wire:model="prizes.0.value" aria-describedby="prizeValueError">
                                        @error('prizes.0.value')
                                            <small class="text-danger" id="prizeValueError">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="prize_quantity" class="mb-2">Prize Quantity (Optional)</label>
                                        <input type="number" id="prize_quantity" class="form-control" wire:model="prizes.0.quantity" aria-describedby="prizeQuantityError">
                                        @error('prizes.0.quantity')
                                            <small class="text-danger" id="prizeQuantityError">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn-custom w-100 p-2 mt-4" type="submit" aria-label="Create Raffle">Create Raffle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#raffle_date_range", {
                mode: "range",
                enableTime: true,
                time_24hr: true,
                dateFormat: "Y-m-d H:i",
                altInput: true,
                altFormat: "F j, Y H:i",
                allowInput: true,
                onChange: function (selectedDates) {
                    if (selectedDates.length === 2) {
                        Livewire.dispatch('setDateRange', {
                            start: selectedDates[0].toISOString().slice(0, 16),
                            end: selectedDates[1].toISOString().slice(0, 16)
                        });
                    }
                }
            });
        });

        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const imageLoader = document.getElementById('imageLoader');

        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (!file) return;

            imagePreview.style.display = 'block';
            imageLoader.style.display = 'inline-block';
            previewImage.style.display = 'none';

            const reader = new FileReader();
            reader.onload = () => {
                previewImage.src = reader.result;
                imageLoader.style.display = 'none';
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        const videoInput = document.getElementById('videoInput');
        const videoPreview = document.getElementById('videoPreview');
        const previewVideo = document.getElementById('previewVideo');
        const videoLoader = document.getElementById('videoLoader');

        videoInput.addEventListener('change', () => {
            const file = videoInput.files[0];
            if (!file) return;

            const blobURL = URL.createObjectURL(file);
            videoPreview.style.display = 'block';
            videoLoader.style.display = 'inline-block';
            previewVideo.style.display = 'none';

            setTimeout(() => {
                previewVideo.src = blobURL;
                videoLoader.style.display = 'none';
                previewVideo.style.display = 'block';
            }, 1000);
        });
    </script>

</div>

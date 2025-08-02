<div>
    <section class="banner">
        <div class="inner">
            <div class="container py-5">
                <div class="banner-wrapper"><img class="rounded-5"
                        src="{{asset("assets/images/home-page-banner.png")}}"
                        alt=""></div>
            </div>
        </div>
    </section>

    <section class="tasks-section">
        <div class="container">
            <h3 class="tasks-title mb-4">Ways To Get Extra Tickets</h3>

            <div class="task-grid">
                @foreach ($tasks as $task)
                    <div class="task-card d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            {!! getPlatformIcon($task->platform) !!}
                            <span class="task-username"> {{ $task->username }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            @php
                                $user = auth()->user();
                                $isCompleted = $user->completedTasks->contains($task->id);
                            @endphp
                            <a href="#" data-id="{{ $task->id }}"
                                class="task-action {{ $isCompleted ? 'opacity-50 cursor-not-allowed' : '' }}"
                                onclick="{{ $isCompleted ? 'return false;' : "openTask({$task->id}, '{$task->link}')" }}">
                                {{ $isCompleted ? 'Completed' : ucfirst($task->action) }}
                            </a>
                            <span class="task-tickets">+{{ $task->reward }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- <section class="tasks-section">
        <div class="container">
            <h3 class="tasks-title mb-4">Ways To Get Extra Tickets</h3>

            <div id="92183-pb7ls0dg" class="sw_container">
                <script type="text/javascript" src="https://sweepwidget.com/w/j/w_init.js"></script>
            </div>
        </div>
    </section> --}}

    <section class="raffles">
        <div class="container">
            <div class="inner py-5">
                <div class="raffle-filter">
                    <ul class="nav nav-tabs gap-4 border-0 my-4 justify-content-center" id="raffleTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill" id="active-tab" data-bs-toggle="tab"
                                data-bs-target="#active" type="button" role="tab" aria-controls="active"
                                aria-selected="true" aria-label="View active raffles">
                                Active
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="upcoming-tab" data-bs-toggle="tab"
                                data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming"
                                aria-selected="false" aria-label="View upcoming raffles">
                                Upcoming
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="past-tab" data-bs-toggle="tab"
                                data-bs-target="#past" type="button" role="tab" aria-controls="past"
                                aria-selected="false" aria-label="View past raffles">
                                Past
                            </button>
                        </li>
                    </ul>
                </div>

                <!-- Raffle Cards by Tab -->
                <div class="tab-content mt-5" id="raffleTabContent">

                    <!-- Active Raffles -->
                    <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab"
                        aria-live="polite" role="region">
                        <div class="row">
                            @forelse ($activeRaffles as $raffle)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                    <article class="card raffle-card" aria-label="{{ $raffle->title }} Raffle">
                                        <img src="{{ Storage::url($raffle->image_path) }}" class="card-img-top"
                                            alt="{{ $raffle->title }} image">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $raffle->title }}</h5>
                                            <p class="raffle-description mb-4">
                                                {{ Str::limit($raffle->description, 100) }}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <p class="card-text">
                                                    <small class="text-muted">Start:
                                                        {{ $raffle->start_date->format('Y-m-d') }}</small>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">End:
                                                        {{ $raffle->end_date->format('Y-m-d') }}</small>
                                                </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-user" aria-hidden="true"></i> :
                                                    {{ $raffle->slots ?? 0 }}
                                                </small>
                                            </p>
                                            <a href="{{ route('raffle', ['id' => $raffle->id]) }}"
                                                class="btn-custom mt-3"
                                                aria-label="View more about {{ $raffle->title }}">
                                                View More
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No active raffles found.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            {{ $activeRaffles->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                    <!-- Upcoming Raffles -->
                    <div class="tab-pane fade" id="upcoming" role="tabpanel" aria-labelledby="upcoming-tab"
                        aria-live="polite" role="region">
                        <div class="row">
                            @forelse ($upcomingRaffles as $raffle)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                    <article class="card raffle-card" aria-label="{{ $raffle->title }} Raffle">
                                        <img src="{{ Storage::url($raffle->image_path) }}" class="card-img-top"
                                            alt="{{ $raffle->title }} image">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $raffle->title }}</h5>
                                            <p class="raffle-description mb-4">
                                                {{ Str::limit($raffle->description, 100) }}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <p class="card-text">
                                                    <small class="text-muted">Start:
                                                        {{ $raffle->start_date->format('Y-m-d') }}</small>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">End:
                                                        {{ $raffle->end_date->format('Y-m-d') }}</small>
                                                </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-user" aria-hidden="true"></i> :
                                                    {{ $raffle->slots ?? 0 }}
                                                </small>
                                            </p>
                                            <a href="{{ route('raffle', ['id' => $raffle->id]) }}"
                                                class="btn-custom mt-3"
                                                aria-label="View more about {{ $raffle->title }}">
                                                View More
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No upcoming raffles found.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            {{ $upcomingRaffles->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                    <!-- Past Raffles -->
                    <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab"
                        aria-live="polite" role="region">
                        <div class="row">
                            @forelse ($pastRaffles as $raffle)
                                <div class="col-lg-4 col-md-6 col-sm-12 mb-3 d-flex align-items-stretch">
                                    <article class="card raffle-card" aria-label="{{ $raffle->title }} Raffle">
                                        <img src="{{ $raffle->image_url ?? 'https://via.placeholder.com/400x300' }}"
                                            class="card-img-top" alt="{{ $raffle->title ?? 'Raffle' }} image">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $raffle->title }}</h5>
                                            <p class="raffle-description mb-4">
                                                {{ Str::limit($raffle->description, 100) }}
                                            </p>
                                            <div class="d-flex align-items-center justify-content-center gap-3">
                                                <p class="card-text">
                                                    <small class="text-muted">Start:
                                                        {{ $raffle->start_date->format('Y-m-d') }}</small>
                                                </p>
                                                <p class="card-text">
                                                    <small class="text-muted">End:
                                                        {{ $raffle->end_date->format('Y-m-d') }}</small>
                                                </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">
                                                    <i class="fa-solid fa-user" aria-hidden="true"></i> :
                                                    {{ $raffle->slots ?? 0 }}
                                                </small>
                                            </p>
                                            <a href="{{ route('raffle', ['id' => $raffle->id]) }}"
                                                class="btn-custom mt-3"
                                                aria-label="View more about {{ $raffle->title }}">
                                                View More
                                            </a>
                                        </div>
                                    </article>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-center">No past raffles found.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            {{ $pastRaffles->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @if ($showRewardModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.6);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header border-0">
                        <h5 class="modal-title w-100">🎉 Task Completed!</h5>
                    </div>
                    <div class="modal-body">
                        <p>You earned <strong>{{ $earnedReward }}</strong> tickets!</p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button wire:click="closeRewardModal" class="btn btn-primary px-4">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


</div>


<script>
    let player = null;
    let watchTimer = null;
    let watchedSeconds = 0;
    let requiredDuration = 0;

    function injectModalHTML() {
        if (document.getElementById('watchModal')) return;

        const modal = document.createElement('div');
        modal.id = 'watchModal';
        modal.className = 'modal fade show';
        modal.style.display = 'block';
        modal.setAttribute('aria-modal', 'true');
        modal.setAttribute('role', 'dialog');
        modal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Watch Video</h5>
                        <button type="button" class="btn-close" onclick="closeWatchModal()"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div id="youtube-player" style="width:100%; height:360px;"></div>
                    </div>
                    <p class="text-center">Watch full video to get reward!</p>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        const backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        backdrop.id = 'modal-backdrop';
        document.body.appendChild(backdrop);
        document.body.classList.add('modal-open');
    }

    function closeWatchModal() {
        const modal = document.getElementById('watchModal');
        const backdrop = document.getElementById('modal-backdrop');

        if (modal) modal.remove();
        if (backdrop) backdrop.remove();
        document.body.classList.remove('modal-open');

        if (player) {
            player.stopVideo();
            player.destroy();
            player = null;
        }

        clearInterval(watchTimer);
        watchTimer = null;
    }

    function loadYoutubePlayer(videoId, duration, taskId) {
        requiredDuration = duration;
        watchedSeconds = 0;

        player = new YT.Player('youtube-player', {
            height: '360',
            width: '640',
            videoId: videoId,
            events: {
                'onStateChange': (event) => {
                    console.log("🎬 Player state changed:", event.data);
                    if (event.data === YT.PlayerState.PLAYING && !watchTimer) {
                        watchTimer = setInterval(() => {
                            watchedSeconds++;

                            console.log("⏱️ Watching seconds:", watchedSeconds);

                            if (watchedSeconds >= requiredDuration) {
                                console.log("🎯 Dispatching task completion");
                                clearInterval(watchTimer);
                                watchTimer = null;

                                console.log("dispatch");

                                Livewire.dispatch('completeTask', {taskId});
                                closeWatchModal();
                            }
                        }, 1000);
                    } else if (event.data !== YT.PlayerState.PLAYING && watchTimer) {
                        clearInterval(watchTimer);
                        watchTimer = null;
                    }
                }
            }
        });
    }

    function openTask(taskId, url) {
        Livewire.dispatch('checkTaskAccess', { taskId, url });
    }

    window.addEventListener('task-access-granted', e => {
        const { taskId, url, meta } = e.detail;

        const taskIdStr = String(taskId);
        const button = document.querySelector(`.task-action[data-id="${taskIdStr}"]`);

        if (!button) return;

        const originalText = button.innerText;
        button.innerText = 'Verifying...';
        button.classList.add('disabled');

        // If it's a YouTube watch task
        if (meta?.video_id && meta?.duration) {
            injectModalHTML();
            setTimeout(() => {
                loadYoutubePlayer(meta.video_id, meta.duration, taskId);
            }, 500);
            return;
        }

        // Otherwise, open normal link and verify on return
        localStorage.setItem(`task_${taskId}_started`, Date.now());
        window.open(url, '_blank');

        window.addEventListener('focus', () => {
            const started = parseInt(localStorage.getItem(`task_${taskId}_started`));
            localStorage.removeItem(`task_${taskId}_started`);
            if (!started) return;

            const elapsed = (Date.now() - started) / 1000;

            if (elapsed >= 1) {
                Livewire.dispatch('completeTask', { taskId });
            } else {
                button.innerText = originalText;
                button.classList.remove('disabled');
            }
        }, { once: true });
    });

    // Load YouTube iframe API
    if (!window.YT || !YT.Player) {
        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        document.head.appendChild(tag);
    }
</script>

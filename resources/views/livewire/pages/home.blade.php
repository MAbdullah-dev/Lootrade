<div>
    <section class="banner">
        <div class="inner">
            <div class="container py-5">
                <div class="banner-wrapper"><img class="rounded-5"
                        src="https://lh3.googleusercontent.com/fife/ALs6j_EnnA4SqdDMZKLowGbim-ysChrQIR0x6I4PUpTP893EE6OoT2z5BO9lkLQw0IFwFaaNLae34bKV61QR3aeM5o9obc9FWTzD2atIgSc3N2tbESsRvDz9Zosz-izsI-9xyMN_JBuoQIaBJ8_-ww2HDUR61q19FYrqRc1tSpi0j4jcsmdImoz9Vnj35xWBu7R8tohNqGnDZrYnOozsOeyJh5ZL-m_uAaG0hn7BZGAG428TQ1WpfdTUYBbK-1c6H-h4hbESx1-KueRyQlbdZeN8v2Ig3KjIAxiW76zITAed3Vwzs8rtVVYdREhA8zxh0atQsBEpB_IdJkM0XTygJllc_fL-40HDSjconwyBHJB4eQsBzsEmEiB6UzuJS4qvU5QwKM1Mrf6Rt0Wnzpyi75IGbNDHw3AT0uwvblAN0MA0sG3a_iF1jb-2aJPXwU2DYA_Frp2BBf0BUMl8JClOTbCpythD3QxTW4G6rSu7HtwJ4BRTlPfNlysfXEk_Mgwn_zlJJ_031j1OwTIDHNVmkwF07VTb2RTZBZKQSrOUjxXnBGFJI47EYHOtIAZuZfiLxVcLkwQEHQZjbE3bGM9uBoTzcS6l2Hh-HQzYCmKNwLdNaVPHlQeh1SwAQmww0m8Lb4oI8Df6Wt8cuvWXfqMt0pXSFFfwlpCQXunOAm-7Xjz6F7TqpXnL5UzPZUXUvhCQE6ST4wuSI12Lq2YZPDleyiQuZd2L_nNRXyP5lfdGPkLomzLo5wdb2LIJ8zJWx88WoQwTcm7K7xUjOt6Npw6KhIqxAT2cBrMLUa3-_jIPmxRLfzBUnCyyWhBRbbFluYUPlK9Na9pOFSHpYRDyyzF0XogKKfeIPkzTJn1zZ00nfhUomuPFcubwN_1t6qDhbgYe2I27gywIVrS7RTuGn19OwrRfvyPJlosBnT5dkwlJDao2U1YhhlrIk_JWzdSru9kjsQbCNhrJi_RWNpak0JqxyLUg7-cZHCT_HyTbY5q--e5FyKf8LW_HAfBmCuN_OJC9iv1EVFIKJ_LHUFEmJpR6C3zeqEh4fGldHDsvLbCxKeiYd43PP7tYWT1L80oNGiRTygvLxLcUd05sJMlJZAPM_C9GeeYSxwzHonsC45IeXxjMfgD3ghejm18OHUTaqcZAnFiBDhIgZomzlv6tKNMimjVdIPoy405il1TSJ4uIXQu50GpEiPS6CvIywgRxoYNbEvZ4auob2pFTKKPDmSsXRy4AjLARirivwYZg0roXMP_oUnqhB2WcwQNxyHIqva8iGcsWjujv9gnC8CJb1f0uAeD-lFaoLV_2ThYmnslQF6m67URp03duPdoHoUoEWLM25FEfym62idoYwjdG_e7hYnK5QhP1MfmjSksr-dW5aMNZq0U5YqoWr_1XmP4soWIvLZEdORJF9zH3TDL_ddaDgkGIrBDRhLTEtIR6zmZ3B9YH6YG81JQhgHAxqNkxQ8wWNhP2jL1ZWHJTJuKVm21NAX6QoPWIMAAyYAtljb1WelKEUCd0ek0cfjAf9f11VngfMhe0Ne1E52y8aD2JIoPHMAWLRUFe-wyJV-Bgc3551INqp4zqRHi2vVYtoAEipP9EGT2GCUTapO7pq1fqFZyRzhSETqslYZ6Ar93A3Qx-PA=w2000-h884?auditContext=forDisplay"
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
                            <span class="task-username">{{ $task->username }}</span>
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
    function openTask(taskId, url) {
        const button = document.querySelector(`.task-action[data-id="${taskId}"]`);
        if (!button) return;

        const originalText = button.innerText;
        button.innerText = 'Verifying...';
        button.classList.add('disabled');

        localStorage.setItem(`task_${taskId}_started`, Date.now());
        window.open(url, '_blank');

        window.addEventListener('focus', () => {
            const started = parseInt(localStorage.getItem(`task_${taskId}_started`));
            localStorage.removeItem(`task_${taskId}_started`);
            if (!started) return;

            const elapsed = (Date.now() - started) / 1000;

            if (elapsed >= 5) {
                Livewire.dispatch('completeTask', { taskId });
            } else {
                button.innerText = originalText;
                button.classList.remove('disabled');
            }
        }, { once: true });
    }
</script>

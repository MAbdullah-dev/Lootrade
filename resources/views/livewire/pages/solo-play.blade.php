<div class="soloplayer" role="main">
    <div class="container">
        <div class="inner py-5">
            <div class="game-box" aria-labelledby="game-title">
                <div class="game-box-head text-center">
                    <h2 id="game-title" class="mb-3">Ticket Tower-Solo</h2>
                    <h3 class="my-4 fs-3 text-center" aria-live="polite">{{ $raffle->title }}</h3>
                </div>

                @if (!empty($raffle->prize))
                    <div class="prize-wrapper text-center" wire:ignore>
                        @if (is_array($raffle->prize))
                            @foreach ($raffle->prize as $prize)
                                <p><strong>Prize: </strong> {{ $prize['name'] }}</p>
                            @endforeach
                        @else
                            <p>No prizes available.</p>
                        @endif
                    </div>
                @else
                    <p>No prizes available.</p>
                @endif

                <div class="grid-wrapper d-flex flex-column justify-content-center align-items-center mt-4">
                    <button
                        class="p-3 w-100 rounded mb-6 flex items-center justify-center my-3"
                        aria-label="Game Info"
                        disabled>
                        Play to win entries in the giveaway!
                    </button>

                    <div class="tile-grid w-100" role="grid" aria-label="Tile grid">
                        @foreach (array_chunk($tiles, 2) as $rowIndex => $tileRow)
                            <div role="row" class="d-flex">
                                @foreach ($tileRow as $index => $tile)
                                    @php
                                        $tileIndex = $rowIndex * 2 + $index;
                                        $isRevealed = in_array($tileIndex, $revealedTiles);
                                        $isCorrect = $tile === 'ticket';
                                        $isWrong = $tile === 'empty';
                                        $tileLabel = $isRevealed ? ($isCorrect ? 'Ticket found' : 'Empty tile') : 'Unrevealed tile';
                                    @endphp
                                    <button
                                        role="gridcell"
                                        class="tile {{ $isRevealed ? ($isCorrect ? 'correct' : 'wrong') : '' }}"
                                        wire:click="revealTile({{ $tileIndex }})"
                                        data-sound="{{ $isRevealed ? 'correct' : ($tile == 'ticket' ? 'correct' : 'wrong') }}"
                                        aria-pressed="{{ $isRevealed ? 'true' : 'false' }}"
                                        aria-label="{{ $tileLabel }}"
                                        title="{{ $tileLabel }}"
                                        {{ $isRevealed || $isWrong ? 'disabled' : '' }}>
                                        <i class="fa-solid fa-ticket" aria-hidden="true"></i>
                                    </button>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div
                        class="playing-btn btn-custom w-100 mt-4"
                        wire:click="startGame"
                        data-sound="play"
                        role="button"
                        tabindex="0"
                        aria-label="{{ $gameActive ? 'Currently playing' : 'Start the game' }}">
                        {{ $gameActive ? 'Playing' : 'Play' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Audio Elements -->
        <audio id="correct-sound" src="{{ asset('sounds/correct-tiles.wav') }}" preload="auto"></audio>
        <audio id="wrong-sound" src="{{ asset('sounds/wrong-tile.wav') }}" preload="auto"></audio>
        <audio id="play-sound" src="{{ asset('sounds/play.wav') }}" preload="auto"></audio>
    </div>

    @if ($awaitingDecision)
        <div class="modal-backdrop fade show" aria-hidden="true"></div>
        <div class="modal fade show d-block" tabindex="-1" role="dialog" aria-modal="true"
            aria-labelledby="decisionModalTitle" aria-describedby="decisionModalDesc"
            style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4 rounded-4">
                    <h3 id="decisionModalTitle" class="mb-3 fw-bold">You've reached this level! 🎉</h3>
                    <p id="decisionModalDesc">
                        Do you want to secure <strong>{{ $earnedEntries }}</strong>
                        {{ $earnedEntries === 1 ? 'entry' : 'entries' }} in the raffle or continue?
                    </p>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button
                            wire:click="secureEntries"
                            class="btn btn-success px-4 py-2"
                            aria-label="Secure entries and stop playing">
                            ✅ Secure
                        </button>
                        <button
                            wire:click="continueGame"
                            class="btn btn-warning px-4 py-2"
                            aria-label="Continue playing the game">
                            🚀 Continue
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('play-sound', ({ sound }) => {
            const audio = document.getElementById(`${sound}-sound`);
            if (audio) {
                audio.currentTime = 0;
                audio.play().catch(err => {
                    console.warn(`Sound ${sound} blocked:`, err);
                });
            } else {
                console.warn(`Audio element for sound ${sound} not found`);
            }
        });
    });
</script>

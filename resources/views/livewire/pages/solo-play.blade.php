<div class="soloplayer">
    <div class="container">
        <div class="inner py-5">
            <div class="game-box">
                <div class="game-box-head text-center">
                    <h2 class="mb-3">Ticket Tower-Solo</h2>
                    <h3 class="my-4 fs-3 text-center">{{ $raffle->title }}</h3>
                    {{-- <p class="mb-2">GIVEAWAY ID: GLBDJVG6</p> --}}
                    {{-- <div class="d-flex align-items-center justify-content-center mb-4 gap-2">
                        <img src="{{ asset('img/awatar.png') }}" class=" rounded-full object-cover" alt="Meet Maba logo">
                        <p class="fs-6">Meet Maba</p>
                    </div> --}}
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
                    <button class="p-3 w-100 rounded mb-6 flex items-center justify-center my-3">
                        Play to win entries in the giveaway!
                    </button>
                    <div class="tile-grid w-100">
                        @foreach (array_chunk($tiles, 2) as $rowIndex => $tileRow)
                            @foreach ($tileRow as $index => $tile)
                                @php
                                    $tileIndex = $rowIndex * 2 + $index;
                                    $isRevealed = in_array($tileIndex, $revealedTiles);
                                    $isCorrect = $tile === 'ticket';
                                    $isWrong = $tile === 'empty';
                                @endphp
                                <button class="tile {{ $isRevealed ? 'correct' : '' }} {{ $isWrong ? 'wrong' : '' }}"
                                    wire:click="revealTile({{ $tileIndex }})"
                                    data-sound="{{ $isRevealed ? 'correct' : ($tile == 'ticket' ? 'correct' : 'wrong') }}"
                                    {{ in_array($tileIndex, $revealedTiles) || $tile === 'empty' ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-ticket"></i>
                                </button>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="playing-btn btn-custom w-100" wire:click="startGame" data-sound="play">
                        {{ $gameActive ? 'Playing' : 'Play' }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Audio Elements -->
        <audio id="correct-sound" src="{{ asset('sounds/correct-tiles.wav') }}"></audio>
        <audio id="wrong-sound" src="{{ asset('sounds/wrong-tile.wav') }}"></audio>
        <audio id="play-sound" src="{{ asset('sounds/play.wav') }}"></audio>
    </div>
    @if ($awaitingDecision)
        <div class="modal-backdrop fade show"></div>
        <div class="modal fade show d-block" tabindex="-1" role="dialog" aria-modal="true"
            style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4 rounded-4">
                    {{-- Heading --}}
                    <h3 class="mb-3 fw-bold">You've reached this level! 🎉</h3>

                    {{-- Subtext --}}
                    <p>
                        Do you want to secure <strong>{{ $earnedEntries }}</strong>
                        {{ $earnedEntries === 1 ? 'entry' : 'entries' }} in the raffle or continue?
                    </p>


                    {{-- Buttons --}}
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <button wire:click="secureEntries" class="btn btn-success px-4 py-2">✅ Secure</button>
                        <button wire:click="continueGame" class="btn btn-warning px-4 py-2">🚀 Continue</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('play-sound', ({
            sound
        }) => {
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

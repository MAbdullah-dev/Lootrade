<div class="battlefield-game">
    <div class="container">
        <div class="inner py-5">
            <h1 class="text-center">Ticket Tower Battlefield</h1>

            @if (!empty($raffle->prize))
                <div class="prize-wrapper text-center" wire:ignore aria-live="polite">
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

            <div class="d-flex my-5 justify-content-center flex-column align-items-center">
                <button wire:click="startGame" class="btn-custom px-5 py-3"
                    @if ($tickets < 10 || $gameStarted) disabled aria-disabled="true" @endif
                    role="button" aria-label="Start Game using 10 tickets">
                    Start Game (10 tickets)
                </button>

                <div class="d-flex justify-content-center mt-4">
                    <h5 class="mt-4" aria-live="polite"><strong>Round: {{ $currentRound }}/20</strong></h5>
                </div>
            </div>

            <div class="row">
                {{-- USER TOWER --}}
                <div class="col-12 col-md-6">
                    <h2 class="text-center">Your Tower</h2>
                    <div class="grid-wrapper">
                        @foreach (array_reverse($userTower) as $rowIndex => $row)
                            @php $actualRow = 4 - $rowIndex; @endphp
                            <div class="tile-grid text-center my-3" role="group" aria-label="Row {{ $actualRow + 1 }}">
                                @foreach ($row as $ticketIndex => $ticket)
                                    <button wire:click="selectTicket('user', {{ $actualRow }}, {{ $ticketIndex }})"
                                        class="tile mx-1
                                        @if ($ticket['selected']) @if ($userRowStates[$actualRow] ?? false) correct
                                            @elseif ($ticket['wrong']) wrong
                                            @elseif ($ticket['correct']) correct @endif
                                        @else
                                            btn-secondary
                                        @endif"
                                        @if ($turn !== 'user' || $userCurrentRow !== $actualRow || $ticket['selected'])
                                            disabled aria-disabled="true"
                                        @endif
                                        role="button"
                                        aria-label="Your ticket {{ $ticketIndex + 1 }} in row {{ $actualRow + 1 }}">
                                        <i class="fa-solid fa-ticket"></i>
                                    </button>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="tower-footer d-flex align-items-center justify-content-center mb-2 gap-2 flex-column">
                            <div class="d-flex align-items-center gap-2">
                                <p class="fs-6" aria-label="Your Score"><i class="fa-solid fa-ticket"></i> {{ $userScore }}</p>
                            </div>
                            <div class="text-center btn-custom w-100" role="status" aria-live="polite">
                                {{ $turn === 'user' ? 'Your Turn' : 'Wait' }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BOT TOWER --}}
                <div class="col-12 col-md-6">
                    <h2 class="text-center">Bot Tower</h2>
                    <div class="grid-wrapper">
                        @foreach (array_reverse($botTower) as $rowIndex => $row)
                            @php $actualRow = 4 - $rowIndex; @endphp
                            <div class="tile-grid text-center  my-3" role="group" aria-label="Bot Row {{ $actualRow + 1 }}">
                                @foreach ($row as $ticketIndex => $ticket)
                                    <button
                                        class="tile mx-1
                                        @if ($ticket['selected']) @if ($botRowStates[$actualRow] ?? false) correct
                                            @elseif ($ticket['wrong']) wrong
                                            @elseif ($ticket['correct']) correct @endif
                                        @else
                                            btn-secondary
                                        @endif"
                                        disabled aria-disabled="true"
                                        role="button"
                                        aria-label="Bot ticket {{ $ticketIndex + 1 }} in row {{ $actualRow + 1 }}">
                                        <i class="fa-solid fa-ticket"></i>
                                    </button>
                                @endforeach
                            </div>
                        @endforeach
                        <div class="tower-footer d-flex align-items-center flex-column justify-content-center gap-2 w-100">
                            <div class="d-flex align-items-center gap-2">
                                <p class="fs-6" aria-label="Bot Score"><i class="fa-solid fa-ticket"></i> {{ $botScore }}</p>
                            </div>
                            <div class="btn-custom text-center w-100" role="status" aria-live="polite">
                                {{ $turn === 'bot' ? 'Bot Turn' : 'Bot is Waiting' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="correct-sound" src="{{ asset('sounds/correct-tiles.wav') }}"></audio>
    <audio id="wrong-sound" src="{{ asset('sounds/wrong-tile.wav') }}"></audio>
    <audio id="play-sound" src="{{ asset('sounds/play.wav') }}"></audio>

    {{-- Winner Modal --}}
    @if ($gameWinner)
        <div class="modal-backdrop fade show"></div>
        <div class="modal fade show d-block" tabindex="-1" role="dialog" aria-modal="true" aria-labelledby="winnerModalHeading" aria-describedby="winnerModalText" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4" tabindex="0">
                    <div class="d-flex justify-content-end" wire:click="redirectBackToRaffle" role="button" aria-label="Close Winner Modal">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <h3 class="mb-3 fw-bold" id="winnerModalHeading">
                        @if ($gameWinner === 'user')
                            🎉 You Won the Game!
                        @elseif ($gameWinner === 'bot')
                            🤖 Bot Won the Game!
                        @else
                            🤝 It's a Tie!
                        @endif
                    </h3>

                    <p class="mb-4 fs-5" id="winnerModalText">
                        @if ($gameWinner === 'user')
                            You have won <strong>5 entries</strong> in the raffle.
                        @elseif ($gameWinner === 'bot')
                            Bot has won the game. Better luck next time!
                        @else
                            No winner this time, try again!
                        @endif
                    </p>

                    <button wire:click="startGame" class="btn-custom px-4 py-2" role="button" aria-label="Play Again">
                        Play Again
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- Bot event logic --}}
<script>
    function waitForLivewire(callback) {
        if (typeof Livewire !== 'undefined') {
            callback();
        } else {
            setTimeout(() => waitForLivewire(callback), 100);
        }
    }

    waitForLivewire(() => {
        window.addEventListener('bot-move', (event) => {
            const data = Array.isArray(event.detail) ? event.detail[0] : event.detail;
            const shouldContinue = data?.continue || false;

            if (shouldContinue) {
                setTimeout(() => {
                    Livewire.dispatch('botTurn');
                }, 1500);
            }
        });

        window.addEventListener('end-round', () => {
            setTimeout(() => {
                Livewire.dispatch('endRound');
            }, 1000);
        });
    });

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

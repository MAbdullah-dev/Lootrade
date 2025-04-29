<?php

namespace App\Jobs;

use App\Models\Raffle;
use App\Models\RaffleTicket;
use App\Models\User;
use App\Models\UserTicket;
use App\Models\Winner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SelectRaffleWinnerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $raffleId;

    public function __construct($raffleId)
    {
        $this->raffleId = $raffleId;
    }

    public function handle()
    {
        DB::transaction(function () {
            $raffle = Raffle::where('id', $this->raffleId)
                            ->where('status', 'active')
                            ->lockForUpdate()
                            ->first();

            if (!$raffle) {
                Log::info('Raffle not found or already closed', ['raffle_id' => $this->raffleId]);
                return; // Raffle not found or already closed
            }

            // Pick random ticket
            $winningTicket = RaffleTicket::where('raffle_id', $raffle->id)
                                ->inRandomOrder()
                                ->first();

            if (!$winningTicket) {
                Log::info('No participants', ['raffle_id' => $raffle->id]);
                return;
            }

             Winner::create([
                'raffle_id' => $raffle->id,
                'user_id' => $winningTicket->user_id,
                'ticket_id' => $winningTicket->id,
                'prize' => $raffle->prize,
            ]);

            $message = "Raffle '{$raffle->title}' has been closed. The winner is: {$winningTicket->user->name}";
            CreateNotificationsJob::dispatch('global', $message);

            $raffle->status = 'past';
            $raffle->save();

            UserTicket::whereIn('id', function ($query) use ($raffle) {
                $query->select('user_ticket_id')
                    ->from('raffle_tickets')
                    ->where('raffle_id', $raffle->id);
            })->update(['status' => 'consumed']);

            GenerateTicketsJob::dispatch($winningTicket->user_id, $raffle->prize);
            $user = User::find($winningTicket->user_id);

             if ($user) 
              {
                $user->ticket_balance += $raffle->prize;
                  $user->save();
            }

        });
    }
}

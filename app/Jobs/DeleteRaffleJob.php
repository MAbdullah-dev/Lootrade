<?php

namespace App\Jobs;

use App\Models\Raffle;
use App\Models\RaffleTicket;
use App\Models\User;
use App\Models\UserTicket;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteRaffleJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $raffleId;

    public function __construct($raffleId)
    {
        $this->raffleId = $raffleId;
    }

    public function handle()
    {
        DB::transaction(function () {
            $raffle = Raffle::findOrFail($this->raffleId);

            $raffleTickets = RaffleTicket::where('raffle_id', $raffle->id)->get();

            foreach ($raffleTickets as $ticket) {
                $userTicket = UserTicket::find($ticket->user_ticket_id);

                if ($userTicket) {
                    $userTicket->status = 'available';
                    $userTicket->save();
                }

                User::where('id', $ticket->user_id)->increment('ticket_balance');
                $ticket->delete();
            }

            $raffle->delete();
        });
    }
}

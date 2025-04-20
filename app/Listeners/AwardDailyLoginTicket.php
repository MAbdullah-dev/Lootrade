<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Services\TicketGenerationService;
use Carbon\Carbon;

class AwardDailyLoginTicket
{
    protected $ticketService;

    public function __construct(TicketGenerationService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $today = Carbon::today()->toDateString();

        if ($user->last_login_award_date !== $today) {
            $this->ticketService->generateTickets($user->id, 1, 'earned');

            $user->update([
                'last_login_at'        => now(),
                'last_login_award_date' => $today,
                'ticket_balance'       => $user->ticket_balance + 1,
            ]);
        }
    }
}

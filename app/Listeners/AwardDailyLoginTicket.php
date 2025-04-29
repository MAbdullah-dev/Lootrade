<?php

namespace App\Listeners;

use App\Jobs\GenerateTicketsJob;
use Illuminate\Auth\Events\Login;
use Carbon\Carbon;

class AwardDailyLoginTicket
{
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
            GenerateTicketsJob::dispatch($user->id, 1, 'earned');

            $user->update([
                'last_login_at'        => now(),
                'last_login_award_date' => $today,
                'ticket_balance'       => $user->ticket_balance + 1,
            ]);

            $user->notifications()->create([
                'type' => 'daily_login_award',
                'message' => 'You have earned your daily 1 ticket for logging in today!',
            ]);

        }
    }
}

<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Raffle;
use App\Mail\RaffleCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendRaffleCreatedEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $raffle;

    public function __construct(Raffle $raffle)
    {
        $this->raffle = $raffle;
    }

    public function handle()
    {
        User::role('user')
            ->select('email')
            ->chunk(100, function ($users) {
                foreach ($users as $user) {
                    Mail::to($user->email)->queue(new RaffleCreatedMail($this->raffle));
                }
            });
    }
}

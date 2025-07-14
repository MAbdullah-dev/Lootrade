<?php

namespace App\Mail;

use App\Models\Raffle;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RaffleCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $raffle;

    public function __construct(Raffle $raffle)
    {
        $this->raffle = $raffle;
    }

    public function build()
    {
        return $this->subject('🎁 A New Raffle Has Been Announced!')
                    ->view('emails.raffle-created');
    }
}


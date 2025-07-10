<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmail extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->view('emails.verify-email', [
                'verifyUrl' => $verifyUrl,
                'user' => $notifiable,
            ])
            ->subject('Verify Your Lootraiders Email');
    }
}

<?php

namespace App\Mail;

use Illuminate\Auth\Notifications\ResetPassword as ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends ResetPassword
{

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->line([
                'You are receiving this email because we received a password reset request for your account.',
                'Click the button below to reset your password:',
            ])
            ->action('Reset Password', url(config('backpack.base.route_prefix').'/password/reset', $this->token))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
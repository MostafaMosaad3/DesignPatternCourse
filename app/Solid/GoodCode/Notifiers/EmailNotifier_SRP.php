<?php

namespace App\Solid\Stripe\Notifiers;

use Illuminate\Support\Facades\Mail;

/**
 * RESPONSIBILITY: Only send email notifications
 * This class has ONE reason to change: if email sending changes
 */
class EmailNotifierSRP
{
    // Only does ONE thing: send emails
    public function notify(string $recipient, string $message): void
    {
        Mail::raw($message, function ($mail) use ($recipient) {
            $mail->to($recipient)->subject('Payment Notification');
        });
    }
}

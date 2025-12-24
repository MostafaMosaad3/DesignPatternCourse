<?php

namespace DesignPattern\Solid\GoodCode\Notifiers;

/**
 * Email notifier - can SUBSTITUTE BaseNotifier
 * Works exactly as expected, no surprises
 */
class EmailNotifierLSP extends BaseNotifier
{
    public function notify(string $recipient, string $message): void
    {
        $formatted = $this->formatMessage($message);
        // Send email
        echo "Email sent to {$recipient}: {$formatted}\n";
    }
}

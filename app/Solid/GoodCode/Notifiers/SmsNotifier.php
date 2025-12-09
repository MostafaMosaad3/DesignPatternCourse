<?php

namespace App\Solid\GoodCode\Notifiers;

/**
 * SMS notifier - can SUBSTITUTE BaseNotifier
 * Follows the same contract, behaves predictably
 */
class SmsNotifier extends BaseNotifier
{
    public function notify(string $recipient, string $message): void
    {
        $formatted = $this->formatMessage($message);
        // Send SMS
        echo "SMS sent to {$recipient}: {$formatted}\n";
    }
}

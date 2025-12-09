<?php

namespace App\Solid\GoodCode\Notifiers;

/**
 * Slack notifier - can SUBSTITUTE BaseNotifier
 * Another implementation that works the same way
 */
class SlackNotifier extends BaseNotifier
{
    public function notify(string $recipient, string $message): void
    {
        $formatted = $this->formatMessage($message);
        // Send Slack message
        echo "Slack message sent to {$recipient}: {$formatted}\n";
    }
}

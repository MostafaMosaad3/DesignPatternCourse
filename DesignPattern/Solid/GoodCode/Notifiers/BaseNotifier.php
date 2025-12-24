<?php

namespace DesignPattern\Solid\GoodCode\Notifiers;


/**
 * Base notifier class
 * All child classes MUST be able to replace this
 */
abstract class BaseNotifier
{
    // Common behavior for all notifiers
    protected function formatMessage(string $message): string
    {
        return "[Payment System] " . $message;
    }

    // Contract that all children must fulfill
    abstract public function notify(string $recipient, string $message): void;
}

<?php

namespace App\Solid\GoodCode\Contracts;

/**
 * Small interface: only for notifications
 */
interface NotifierInterface
{
    public function notify(string $recipient, string $message): void;
}

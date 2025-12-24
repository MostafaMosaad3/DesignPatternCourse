<?php

namespace DesignPattern\Solid\GoodCode\Loggers;

use App\Solid\GoodCode\Loggers\Log;

/**
 * RESPONSIBILITY: Only log payment activities
 * This class has ONE reason to change: if logging method changes
 */
class PaymentLogger
{
    // Only does ONE thing: log messages
    public function log(string $message, array $context): void
    {
        Log::info($message, $context);
    }
}

<?php

namespace DesignPattern\Solid\GoodCode\Services;

use DesignPattern\Solid\GoodCode\Contracts\ChargeableInterface;

/**
 * This gateway ONLY does charges (maybe it's read-only)
 * It implements ONLY ChargeableInterface
 */
class ReadOnlyPaymentGateway implements ChargeableInterface
{
    public function charge(float $amount, string $currency, array $metadata): array
    {
        // Implementation
        return [];
    }

    // No refund method! Doesn't need it!
}

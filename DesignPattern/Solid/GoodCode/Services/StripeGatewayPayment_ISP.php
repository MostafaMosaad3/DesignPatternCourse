<?php

namespace DesignPattern\Solid\GoodCode\Services;

use DesignPattern\Solid\GoodCode\Contracts\ChargeableInterface;
use DesignPattern\Solid\GoodCode\Contracts\RefundableInterface;

/**
 * This gateway does charges AND refunds
 * So it implements both interfaces
 */
class StripeGatewayPayment_ISP implements ChargeableInterface, RefundableInterface
{
    public function charge(float $amount, string $currency, array $metadata): array
    {
        // Implementation
        return [];
    }

    public function refund(string $transactionId, float $amount): array
    {
        // Implementation
        return [];
    }
}

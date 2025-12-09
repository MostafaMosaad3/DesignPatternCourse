<?php

namespace App\Solid\GoodCode\Services;

use App\Solid\GoodCode\Contracts\ChargeableInterface;
use App\Solid\GoodCode\Contracts\RefundableInterface;

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

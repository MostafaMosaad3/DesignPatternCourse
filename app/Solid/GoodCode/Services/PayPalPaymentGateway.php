<?php

namespace App\Solid\GoodCode\Services;

use App\Solid\GoodCode\Contracts\ChargeableInterface;
use App\Solid\GoodCode\Contracts\RefundableInterface;

class PayPalPaymentGateway implements ChargeableInterface , RefundableInterface
{
    public function charge(float $amount, string $currency, array $metadata): array
    {
        // PayPal implementation
        return [];
    }

    public function refund(string $transactionId, float $amount): array
    {
        // PayPal implementation
        return [];
    }
}

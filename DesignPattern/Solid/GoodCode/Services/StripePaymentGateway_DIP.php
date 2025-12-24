<?php

namespace DesignPattern\Solid\GoodCode\Services;


use DesignPattern\Solid\GoodCode\Contracts\ChargeableInterface;
use DesignPattern\Solid\GoodCode\Contracts\RefundableInterface;
use Stripe\StripeClient;

class StripePaymentGateway_DIP implements ChargeableInterface , RefundableInterface
{
    private StripeClient $stripe;

    public function __construct(string $apiKey)
    {
        $this->stripe = new StripeClient($apiKey);
    }

    public function charge(float $amount, string $currency, array $metadata): array
    {
        // Stripe implementation
        return [];
    }

    public function refund(string $transactionId, float $amount): array
    {
        // Stripe implementation
        return [];
    }
}

<?php

namespace DesignPattern\Solid\GoodCode\Services;

use App\Solid\GoodCode\StripeClient;

/**
 * RESPONSIBILITY: Only communicate with Stripe API
 * This class has ONE reason to change: if Stripe API changes
 */

class StripePaymentGatewaySRP
{
    private StripeClient $stripe;

    public function __construct(string $apiKey)
    {
        $this->stripe = new StripeClient($apiKey);
    }

    // Only does ONE thing: charge via Stripe
    public function charge(float $amount, string $currency, array $metadata): array
    {
        $paymentIntent = $this->stripe->paymentIntents->create([
            'amount' => $amount * 100,
            'currency' => $currency,
            'metadata' => $metadata,
        ]);

        return [
            'id' => $paymentIntent->id,
            'status' => $paymentIntent->status,
            'amount' => $paymentIntent->amount / 100,
        ];
    }

    // Only does ONE thing: refund via Stripe
    public function refund(string $transactionId, float $amount): array
    {
        $refund = $this->stripe->refunds->create([
            'payment_intent' => $transactionId,
            'amount' => $amount * 100,
        ]);

        return [
            'id' => $refund->id,
            'status' => $refund->status,
            'amount' => $refund->amount / 100,
        ];
    }
}

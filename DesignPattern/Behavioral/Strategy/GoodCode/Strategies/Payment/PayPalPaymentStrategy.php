<?php

namespace DesignPattern\Strategy\GoodCode\Strategies\Payment;

use DesignPattern\Strategy\GoodCode\Contracts\PaymentStrategy;


/**
 * CONCRETE STRATEGY 1: PayPal Payment
 *
 * RESPONSIBILITY: Process payment via PayPal
 * FEE: 2.9% + $0.30
 * PROCESSING: Instant
 */
class PayPalPaymentStrategy implements PaymentStrategy
{
    private float $percentageFee = 2.9;
    private float $fixedFee = 0.30;

    public function processPayment(float $amount): array
    {
        $fee = $this->calculateFee($amount);
        $total = $amount + $fee;

        // Simulate PayPal API call
        return [
            'success' => true,
            'method' => 'PayPal',
            'amount' => $amount,
            'fee' => $fee,
            'total' => $total,
            'transaction_id' => 'PAYPAL_' . uniqid(),
            'processing_time' => 'Instant'
        ];
    }

    public function calculateFee(float $amount): float
    {
        return ($amount * ($this->percentageFee / 100)) + $this->fixedFee;
    }

    public function getMethodName(): string
    {
        return "PayPal";
    }
}

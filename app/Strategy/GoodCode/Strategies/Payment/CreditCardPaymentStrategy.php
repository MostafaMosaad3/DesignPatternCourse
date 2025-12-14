<?php

namespace App\Strategy\GoodCode\Strategies\Payment;


use App\Strategy\GoodCode\Contracts\PaymentStrategy;

/**
 * CONCRETE STRATEGY 2: Credit Card Payment
 *
 * RESPONSIBILITY: Process payment via Credit Card
 * FEE: 2.5% + $0.25
 * PROCESSING: Instant
 */
class CreditCardPaymentStrategy implements PaymentStrategy
{
    private float $percentageFee = 2.5;
    private float $fixedFee = 0.25;

    public function processPayment(float $amount): array
    {
        $fee = $this->calculateFee($amount);
        $total = $amount + $fee;

        // Simulate credit card processing
        return [
            'success' => true,
            'method' => 'Credit Card',
            'amount' => $amount,
            'fee' => $fee,
            'total' => $total,
            'transaction_id' => 'CC_' . uniqid(),
            'processing_time' => 'Instant'
        ];
    }

    public function calculateFee(float $amount): float
    {
        return ($amount * ($this->percentageFee / 100)) + $this->fixedFee;
    }

    public function getMethodName(): string
    {
        return "Credit Card";
    }
}

<?php

namespace App\Strategy\GoodCode\Strategies\Payment;

use App\Strategy\GoodCode\Contracts\PaymentStrategy;

/**
 * CONCRETE STRATEGY 3: Bank Transfer Payment
 *
 * RESPONSIBILITY: Process payment via Bank Transfer
 * FEE: $0 (no fee)
 * PROCESSING: 3-5 business days
 */
class BankTransferPaymentStrategy implements PaymentStrategy
{
    public function processPayment(float $amount): array
    {
        $fee = $this->calculateFee($amount);
        $total = $amount + $fee;

        // Simulate bank transfer
        return [
            'success' => true,
            'method' => 'Bank Transfer',
            'amount' => $amount,
            'fee' => $fee,
            'total' => $total,
            'transaction_id' => 'BANK_' . uniqid(),
            'processing_time' => '3-5 business days'
        ];
    }

    public function calculateFee(float $amount): float
    {
        // Bank transfer has no fee
        return 0.00;
    }

    public function getMethodName(): string
    {
        return "Bank Transfer";
    }
}

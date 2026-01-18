<?php

namespace DesignPattern\Structural\Facade\GoodCode;

class PaymentService
{
    public function processPayment(float $amount): string
    {
        // Complex payment processing
        return "Payment of \${$amount} processed successfully";
    }
}

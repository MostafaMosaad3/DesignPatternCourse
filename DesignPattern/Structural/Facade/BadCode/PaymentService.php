<?php

namespace DesignPattern\Structural\Facade\BadCode;

class PaymentService
{
    public function processPayment(float $amount): string
    {
        // Complex payment processing
        return "Payment of \${$amount} processed successfully";
    }
}

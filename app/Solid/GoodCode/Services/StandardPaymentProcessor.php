<?php

namespace App\Solid\GoodCode\Services;

/**
 * Standard payment implementation
 * EXTENDS PaymentProcessor WITHOUT modifying it
 */
class StandardPaymentProcessor extends PaymentProcessor
{
    public function process(array $data): array
    {
        $this->beforeProcess($data);

        $result = $this->gateway->charge(
            $data['amount'],
            $data['currency'],
            $data['metadata'] ?? []
        );

        $this->afterProcess($result);

        return $result;
    }
}

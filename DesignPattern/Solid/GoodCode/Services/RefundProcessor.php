<?php

namespace DesignPattern\Solid\GoodCode\Services;

/**
 * Want to add a RefundProcessor? Just extend!
 * NO need to modify existing code!
 */
class RefundProcessor extends PaymentProcessor
{
    public function process(array $data): array
    {
        $this->beforeProcess($data);

        $result = $this->gateway->refund(
            $data['transaction_id'],
            $data['amount']
        );

        $this->afterProcess($result);

        return $result;
    }
}

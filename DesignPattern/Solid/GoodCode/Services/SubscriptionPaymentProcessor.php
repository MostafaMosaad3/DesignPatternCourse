<?php

namespace DesignPattern\Solid\GoodCode\Services;

/**
 * Subscription payment implementation
 * EXTENDS PaymentProcessor WITHOUT modifying existing code
 * This is OCP in action!
 */
class SubscriptionPaymentProcessor extends PaymentProcessor
{
    public function process(array $data): array
    {
        $this->beforeProcess($data);

        // Add subscription-specific behavior
        $metadata = array_merge($data['metadata'] ?? [], [
            'type' => 'subscription',
            'billing_cycle' => $data['billing_cycle'] ?? 'monthly'
        ]);

        $result = $this->gateway->charge(
            $data['amount'],
            $data['currency'],
            $metadata
        );

        $this->afterProcess($result);

        return $result;
    }
}

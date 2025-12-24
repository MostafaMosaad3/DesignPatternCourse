<?php

namespace DesignPattern\Strategy\GoodCode\Contracts;

/**
 * STEP 4: Define Payment Strategy Interface
 *
 * This is the contract that ALL payment strategies must follow
 */
interface PaymentStrategy
{
    /**
     * Process payment
     *
     * @param float $amount Amount to charge
     * @return array Payment result with details
     */
    public function processPayment(float $amount): array;

    /**
     * Calculate processing fee
     *
     * @param float $amount Amount to charge
     * @return float Fee amount
     */
    public function calculateFee(float $amount): float;

    /**
     * Get payment method name
     *
     * @return string Payment method name
     */
    public function getMethodName(): string;
}

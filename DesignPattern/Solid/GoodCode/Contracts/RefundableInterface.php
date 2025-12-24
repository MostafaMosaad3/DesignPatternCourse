<?php

namespace DesignPattern\Solid\GoodCode\Contracts;

/**
 * Small interface: only for refunds
 * Classes that don't refund don't need to implement this
 */
interface RefundableInterface
{
    public function refund(string $transactionId, float $amount): array;
}


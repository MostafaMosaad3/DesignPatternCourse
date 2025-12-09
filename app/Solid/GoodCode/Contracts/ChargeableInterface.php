<?php

namespace App\Solid\GoodCode\Contracts;

/**
 * Small interface: only for charging
 * Classes that don't charge don't need to implement this
 */
interface ChargeableInterface
{
    public function charge(float $amount, string $currency, array $metadata): array;
}

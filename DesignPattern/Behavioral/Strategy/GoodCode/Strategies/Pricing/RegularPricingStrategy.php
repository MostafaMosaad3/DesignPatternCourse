<?php

namespace DesignPattern\Strategy\GoodCode\Strategies\Pricing;

use DesignPattern\Strategy\GoodCode\Contracts\PricingStrategy;

/**
 * CONCRETE STRATEGY 1: Regular Customer Pricing
 *
 * RESPONSIBILITY: Calculate price for regular customers (no discount)
 * WHEN USED: For non-members or basic customers
 */
class RegularPricingStrategy implements PricingStrategy
{
    public function calculatePrice(float $basePrice): float
    {
        // Regular customers pay full price
        return $basePrice;
    }


    public function getDescription(): string
    {
        return "Regular pricing (0% discount)";
    }
}

<?php

namespace DesignPattern\Strategy\GoodCode\Strategies\Pricing;

use DesignPattern\Strategy\GoodCode\Contracts\PricingStrategy;

/**
 * CONCRETE STRATEGY 2: Gold Member Pricing
 *
 * RESPONSIBILITY: Calculate price for gold members (10% discount)
 * WHEN USED: For customers with gold membership
 */
class GoldMemberPricingStrategy implements PricingStrategy
{
    private float $discountPercentage = 10.0;

    public function calculatePrice(float $basePrice): float
    {
        // Gold members get 10% discount
        $discount = $basePrice * ($this->discountPercentage / 100);
        return $basePrice - $discount;
    }

    public function getDescription(): string
    {
        return "Gold member pricing (10% discount)";
    }
}

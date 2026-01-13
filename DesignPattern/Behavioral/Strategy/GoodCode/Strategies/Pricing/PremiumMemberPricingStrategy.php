<?php

namespace DesignPattern\Strategy\GoodCode\Strategies\Pricing;

use DesignPattern\Strategy\GoodCode\Contracts\PricingStrategy;

/**
 * CONCRETE STRATEGY 3: Premium Member Pricing
 *
 * RESPONSIBILITY: Calculate price for premium members (20% discount)
 * WHEN USED: For customers with premium membership
 */
class PremiumMemberPricingStrategy implements PricingStrategy
{
    private float $discountPercentage = 20.0;

    public function calculatePrice(float $basePrice): float
    {
        // Premium members get 20% discount
        $discount = $basePrice * ($this->discountPercentage / 100);
        return $basePrice - $discount;
    }

    public function getDescription(): string
    {
        return "Premium member pricing (20% discount)";
    }
}

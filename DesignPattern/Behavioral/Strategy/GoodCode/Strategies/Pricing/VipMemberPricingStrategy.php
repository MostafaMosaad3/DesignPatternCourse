<?php

namespace DesignPattern\Strategy\GoodCode\Strategies\Pricing;

use DesignPattern\Strategy\GoodCode\Contracts\PricingStrategy;

/**
 * EASY TO ADD MORE! Want VIP pricing? Just create new class!
 * No need to modify existing code! (Open/Closed Principle)
 */
class VipMemberPricingStrategy implements PricingStrategy
{
    private float $discountPercentage = 30.0;

    public function calculatePrice(float $basePrice): float
    {
        $discount = $basePrice * ($this->discountPercentage / 100);
        return $basePrice - $discount;
    }

    public function getDescription(): string
    {
        return "VIP member pricing (30% discount)";
    }
}

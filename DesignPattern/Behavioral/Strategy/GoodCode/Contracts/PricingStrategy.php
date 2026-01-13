<?php

namespace DesignPattern\Strategy\GoodCode\Contracts;

/**
 * STEP 1: Define the Strategy Interface
 *
 * This is the contract that ALL pricing strategies must follow
 * All strategies must have calculatePrice() method
 */
interface PricingStrategy
{
    /**
     * Calculate final price based on strategy
     *
     * @param float $basePrice The original price
     * @return float The final price after applying strategy
     */
    public function calculatePrice(float $basePrice): float;

    /**
     * Get description of this pricing strategy
     *
     * @return string Description for display
     */
    public function getDescription(): string;
}

/**
 * WHY INTERFACE?
 * - Ensures all strategies have calculatePrice() method
 * - Makes strategies interchangeable
 * - Context can use any strategy
 * - Follows Dependency Inversion Principle
 */

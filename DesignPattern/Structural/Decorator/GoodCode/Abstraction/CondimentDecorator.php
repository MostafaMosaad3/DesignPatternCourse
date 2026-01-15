<?php

namespace DesignPattern\Structural\Decorator\GoodCode\Abstraction;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\Beverage;

/**
 * WHY USE ABSTRACT DECORATOR?
 * ✅ Avoids code duplication in decorators
 * ✅ All decorators need to store wrapped beverage
 * ✅ Put common code here, not in each decorator
 */

class CondimentDecorator implements Beverage
{
    protected $beverage; // ✅ Common to all decorators

    /**
     * ✅ Constructor in ONE place
     * All decorators inherit this
     */
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    /**
     * ✅ Default delegation
     * Decorators can override if needed
     */
    public function cost(): float
    {
        return $this->beverage->cost();
    }

    public function description(): string
    {
        return $this->beverage->description();
    }
}

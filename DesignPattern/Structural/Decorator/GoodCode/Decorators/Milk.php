<?php

namespace DesignPattern\Structural\Decorator\GoodCode\Decorators;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\CondimentDecorator;

// ============================================
// STEP 4: CONCRETE DECORATORS
// ============================================

/**
 * ✅ Notice: Each decorator now extends CondimentDecorator
 * ✅ No need to repeat $beverage property
 * ✅ No need to repeat constructor
 * ✅ Just override methods to add functionality
 */

class Milk extends CondimentDecorator
{
    public function cost(): float
    {
        return $this->beverage->cost() + 0.30;
    }

    public function description(): string
    {
        return $this->beverage->description() . ', Milk';
    }
}

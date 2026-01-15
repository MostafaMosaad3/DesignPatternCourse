<?php

namespace DesignPattern\Structural\Decorator\GoodCode\Decorators;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\CondimentDecorator;

class WhippedCream extends CondimentDecorator
{
    public function cost(): float
    {
        return $this->beverage->cost() + 0.50;
    }

    public function description(): string
    {
        return $this->beverage->description() . ", Whipped Cream";
    }
}

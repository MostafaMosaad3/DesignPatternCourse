<?php

namespace DesignPattern\Structural\Decorator\GoodCode\Decorators;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\CondimentDecorator;

class Sugar extends CondimentDecorator
{
    public function cost(): float
    {
        return $this->beverage->cost() + 0.20;
    }

    public function description(): string
    {
        return $this->beverage->description() . ", Sugar";
    }
}

<?php

namespace DesignPattern\Structural\Decorator\GoodCode\ConcreteComponents;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\Beverage;

class Tea implements Beverage
{

    public function cost(): float
    {
        return 1.50 ;
    }

    public function description(): string
    {
        return 'Tea' ;
    }
}

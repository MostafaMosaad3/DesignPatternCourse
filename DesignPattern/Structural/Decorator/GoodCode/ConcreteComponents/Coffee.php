<?php

namespace DesignPattern\Structural\Decorator\GoodCode\ConcreteComponents;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\Beverage;

class Coffee implements Beverage
{

    public function cost(): float
    {
        return 2.00 ;
    }

    public function description(): string
    {
        return 'Coffee' ;
    }
}

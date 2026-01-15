<?php

namespace DesignPattern\Structural\Decorator\BadCode\Combinations;

class CoffeeWithMilkAndSugar
{
    public function cost(): float
    {
        return 2.00 + 0.30 + 0.20; // ❌ Duplicated
    }

    public function description(): string
    {
        return "Coffee with Milk and Sugar";
    }
}

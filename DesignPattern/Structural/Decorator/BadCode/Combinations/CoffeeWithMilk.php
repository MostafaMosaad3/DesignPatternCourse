<?php

namespace DesignPattern\Structural\Decorator\BadCode\Combinations;

class CoffeeWithMilk
{
    public function cost(): float
    {
        return 2.00 + 0.30; // ❌ Duplicated base cost
    }

    public function description(): string
    {
        return "Coffee with Milk";
    }
}

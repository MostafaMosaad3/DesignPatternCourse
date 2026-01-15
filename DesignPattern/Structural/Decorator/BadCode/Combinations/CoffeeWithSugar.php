<?php

namespace DesignPattern\Structural\Decorator\BadCode\Combinations;

class CoffeeWithSugar
{
    public function cost(): float
    {
        return 2.00 + 0.20; // ❌ Duplicated
    }

    public function description(): string
    {
        return "Coffee with Sugar";
    }
}

<?php

namespace DesignPattern\Structural\Decorator\BadCode\Combinations;

class CoffeeWithMilkAndSugarAndWhippedCream
{
    public function cost(): float
    {
        return 2.00 + 0.30 + 0.20 + 0.50; // ❌ Duplicated
    }

    public function description(): string
    {
        return "Coffee with Milk, Sugar and Whipped Cream";
    }
}

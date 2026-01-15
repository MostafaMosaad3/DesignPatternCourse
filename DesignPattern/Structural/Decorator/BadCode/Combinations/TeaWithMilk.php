<?php

namespace DesignPattern\Structural\Decorator\BadCode\Combinations;

class TeaWithMilk
{
    public function cost(): float
    {
        return 1.50 + 0.30;
    }

    public function description(): string
    {
        return "Tea with Milk";
    }
}

/**
 * ============================================
 * PROBLEMS:
 * ============================================
 *
 * 1. CLASS EXPLOSION:
 *    ❌ 2 beverages × 4 condiments = 16+ combinations
 *    ❌ Each combination = separate class
 *    ❌ Add new condiment? Double the classes!
 *
 * 2. CODE DUPLICATION:
 *    ❌ Base cost (2.00) repeated everywhere
 *    ❌ Condiment costs repeated
 *    ❌ Change coffee price? Update 10+ classes!
 *
 * 3. HARD TO ADD NEW CONDIMENT:
 *    ❌ Add "Caramel"? Create 8+ new classes
 *    ❌ CoffeeWithCaramel, CoffeeWithMilkAndCaramel...
 *
 * 4. HARD TO MAINTAIN:
 *    ❌ Change milk price? Update all classes with milk
 *    ❌ Bug in one class? Might be in all
 *
 * 5. CALCULATION:
 *    Without Decorator:
 *    ❌ 2 beverages, 4 condiments
 *    ❌ 2^4 = 16 combinations × 2 = 32 classes!
 *
 * ============================================
 * SOLUTION: USE DECORATOR PATTERN!
 * ============================================
 */

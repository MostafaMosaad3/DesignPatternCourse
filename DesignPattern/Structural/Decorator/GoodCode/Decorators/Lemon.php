<?php

namespace DesignPattern\Structural\Decorator\GoodCode\Decorators;

use DesignPattern\Structural\Decorator\GoodCode\Abstraction\CondimentDecorator;

class Lemon extends CondimentDecorator
{
    public function cost(): float
    {
        return $this->beverage->cost() + 0.15;
    }

    public function description(): string
    {
        return $this->beverage->description() . ", Lemon";
    }
}
/**
 * ============================================
 * ADVANTAGES:
 * ============================================
 *
 * 1. NO CLASS EXPLOSION:
 *    ✅ 2 beverages + 5 condiments = 7 classes
 *    ✅ Bad code had 32+ classes!
 *
 * 2. NO CODE DUPLICATION:
 *    ✅ Coffee cost in ONE place
 *    ✅ Milk cost in ONE place
 *    ✅ Change price? Update one class!
 *
 * 3. EASY TO ADD CONDIMENT:
 *    ✅ Add Caramel? Just ONE class
 *    ✅ Works with all beverages automatically!
 *
 * 4. FLEXIBLE COMBINATIONS:
 *    ✅ Any combination possible
 *    ✅ new Milk(new Sugar(new Coffee()))
 *    ✅ new Lemon(new Sugar(new Tea()))
 *    ✅ Unlimited!
 *
 * 5. EASY TO MAINTAIN:
 *    ✅ Change milk price? Update Milk class only
 *    ✅ Change coffee price? Update Coffee class only
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * TOTAL CLASSES:
 *
 * BAD CODE (2 beverages, 4 condiments):
 * ❌ 2^4 combinations × 2 beverages = 32 classes
 *
 * GOOD CODE (2 beverages, 4 condiments):
 * ✅ 2 + 4 = 6 classes
 *
 * ADD NEW CONDIMENT (Caramel):
 *
 * BAD CODE:
 * ❌ Create 16 new classes
 * ❌ CoffeeWithCaramel, CoffeeWithMilkAndCaramel...
 *
 * GOOD CODE:
 * ✅ Create 1 class: Caramel
 * ✅ Works with all combinations!
 *
 * CHANGE MILK PRICE:
 *
 * BAD CODE:
 * ❌ Update 16 classes (all with milk)
 *
 * GOOD CODE:
 * ✅ Update 1 class: Milk
 *
 * CREATE COMBINATION:
 *
 * BAD CODE:
 * ❌ new CoffeeWithMilkAndSugarAndWhippedCream()
 * ❌ Class must exist!
 *
 * GOOD CODE:
 * ✅ new WhippedCream(new Sugar(new Milk(new Coffee())))
 * ✅ Any combination possible!
 *
 * That's the power of Decorator Pattern! 🚀
 */

<?php

namespace DesignPattern\Structural\Decorator\GoodCode\Abstraction;

// ============================================
// GOOD CODE: WITH DECORATOR PATTERN
// ============================================

/**
 * BENEFITS:
 * ✅ Only 6 classes (not 32!)
 * ✅ No code duplication
 * ✅ Easy to add new condiment
 * ✅ Flexible combinations
 */

// ============================================
// COMPONENT INTERFACE
//

interface Beverage
{
    public function cost():float ;
    public function description():string;
}

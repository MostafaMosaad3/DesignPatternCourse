<?php

namespace DesignPattern\Structural\Decorator\BadCode;

// ============================================
// BAD CODE: WITHOUT DECORATOR PATTERN
// ============================================

/**
 * PROBLEMS:
 * ❌ Class explosion (every combination = new class)
 * ❌ Code duplication
 * ❌ Hard to add new condiment
 * ❌ Hard to maintain
 */

class Coffee
{
    public function cost() :float
    {
        return 2.00 ;
    }

    public function description() :string
    {
        return 'Coffee' ;
    }
}

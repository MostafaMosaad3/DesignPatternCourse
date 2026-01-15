<?php

namespace DesignPattern\Structural\Composite\GoodCode;

// ============================================
// GOOD CODE: WITH COMPOSITE PATTERN
// ============================================

/**
 * BENEFITS:
 * ✅ Same interface for employee and department
 * ✅ No type checking needed
 * ✅ Easy to calculate total salary
 * ✅ Clean code
 */

interface EmployeeComponent
{
    public function getSalary(): float;
    public function getName(): string ;
}

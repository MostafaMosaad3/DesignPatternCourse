<?php

namespace DesignPattern\Structural\Composite\BadCode;

// ============================================
// BAD CODE: WITHOUT COMPOSITE PATTERN
// ============================================

/**
 * PROBLEMS:
 * ❌ Different classes for employee and department
 * ❌ Client must check type
 * ❌ Hard to calculate total salary
 * ❌ Code duplication
 */

class Employee
{
    public $name ;
    public $salary ;

    public function __construct(string $name, int $salary)
    {
        $this->name = $name;
        $this->Salary = $salary;
    }


    public function getSalary(): float
    {
        return $this->Salary;
    }
}

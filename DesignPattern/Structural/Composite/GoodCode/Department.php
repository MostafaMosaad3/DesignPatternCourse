<?php

namespace DesignPattern\Structural\Composite\GoodCode;

use DesignPattern\Structural\Composite\GoodCode\EmployeeComponent;

class Department implements EmployeeComponent
{

    private $name ;
    private $children = []; // ✅ Single array for all!

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function add(EmployeeComponent $component): void
    {
        $this->children[] = $component;
    }

    public function getSalary(): float
    {
        $total = 0 ;
        foreach ($this->children as $child) {
            $total += $child->getSalary(); // Works for both!
        }

        return $total;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

/**
 * ============================================
 * ADVANTAGES:
 * ============================================
 *
 * 1. UNIFORM INTERFACE:
 *    ✅ Both have getSalary()
 *    ✅ Same method name!
 *
 * 2. NO TYPE CHECKING:
 *    ✅ No instanceof needed
 *    ✅ Client code simple
 *
 * 3. SINGLE STORAGE:
 *    ✅ Department has one array
 *    ✅ $children contains both employees and departments
 *    ✅ Single loop!
 *
 * 4. EASY TO EXTEND:
 *    ✅ Add new type? Just implement interface
 *    ✅ No changes to existing code
 *
 * 5. RECURSIVE:
 *    ✅ Department calls getSalary() on children
 *    ✅ Children might be employees or departments
 *    ✅ Works automatically!
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * CALCULATE TOTAL SALARY:
 *
 * BAD CODE:
 * ❌ Loop through employees array
 * ❌ Loop through subDepartments array
 * ❌ Call different methods
 * ❌ Complex code
 *
 * GOOD CODE:
 * ✅ Loop through children once
 * ✅ Call getSalary() on all
 * ✅ Automatic recursion
 * ✅ Simple code
 *
 * ADD NEW COMPONENT:
 *
 * BAD CODE:
 * ❌ Check type: if employee use addEmployee()
 * ❌ If department use addSubDepartment()
 *
 * GOOD CODE:
 * ✅ Always use add()
 * ✅ Works for any component
 *
 * CLIENT CODE:
 *
 * BAD CODE:
 * ❌ if ($x instanceof Employee) $x->getSalary()
 * ❌ if ($x instanceof Department) $x->getTotalSalary()
 *
 * GOOD CODE:
 * ✅ $x->getSalary() // Always works!
 *
 * That's the power of Composite Pattern! 🚀
 */

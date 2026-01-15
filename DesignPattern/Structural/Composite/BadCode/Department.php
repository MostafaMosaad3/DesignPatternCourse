<?php

namespace DesignPattern\Structural\Composite\BadCode;

class Department
{
    public $name ;
    public $employees = [];
    public $subDepartments = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addEmployee(Employee $employee) :void
    {
        $this->employees[] = $employee;
    }

    public function addSubDepartment(Department $department) :void
    {
        $this->subDepartments[] = $department;
    }

    /**
     * ❌ BAD: Must manually handle both employees and sub-departments
     */

    public function getTotalSalary(): float
    {
        $total = 0;

        // Add employee salaries
        foreach ($this->employees as $emp) {
            $total += $emp->getSalary();
        }

        // Add sub-department salaries
        foreach ($this->subDepartments as $dept) {
            $total += $dept->getTotalSalary(); // Different method name!
        }

        return $total;
    }
}

/**
 * ============================================
 * PROBLEMS:
 * ============================================
 *
 * 1. NO UNIFORM INTERFACE:
 *    ❌ Employee: getSalary()
 *    ❌ Department: getTotalSalary()
 *    ❌ Different method names!
 *
 * 2. TYPE CHECKING NEEDED:
 *    ❌ Must use instanceof
 *    ❌ Client code complicated
 *
 * 3. SEPARATE STORAGE:
 *    ❌ Department has two arrays
 *    ❌ $employees and $subDepartments
 *    ❌ Must loop through both
 *
 * 4. HARD TO EXTEND:
 *    ❌ Add new type? Update all code
 *    ❌ More if statements
 *
 * ============================================
 * SOLUTION: USE COMPOSITE PATTERN!
 * ============================================
 */

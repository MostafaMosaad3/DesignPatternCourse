<?php

namespace DesignPattern\Structural\Composite\GoodCode;

use DesignPattern\Structural\Composite\GoodCode\EmployeeComponent;


// ============================================
// LEAF: INDIVIDUAL EMPLOYEE
// ============================================


class Employee implements EmployeeComponent
{

    private $name ;
    private $salary;

    public function __construct(string $name, float $salary)
    {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

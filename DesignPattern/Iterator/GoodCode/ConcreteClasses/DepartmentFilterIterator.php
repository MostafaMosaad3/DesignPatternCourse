<?php

namespace DesignPattern\Iterator\GoodCode\ConcreteClasses;

use DesignPattern\Iterator\GoodCode\Contracts\EmployeeIterator;
use DesignPattern\Iterator\GoodCode\Employee;

class DepartmentFilterIterator implements EmployeeIterator
{
    private $employees = [];
    private $position = 0;

    public function __construct(Employee $root, string $department)
    {
        $allIterator = new AllSubordinatesIterator($root);

        while ($allIterator->hasNext()) {
            $employee = $allIterator->next();
            if ($employee->getDepartment() === $department) {
                $this->employees[] = $employee;
            }
        }
    }

    public function hasNext(): bool
    {
        return $this->position < count($this->employees);
    }

    public function next(): ?Employee
    {
        if (!$this->hasNext()) {
            return null;
        }
        return $this->employees[$this->position++];
    }

    public function current(): ?Employee
    {
        return $this->employees[$this->position] ?? null;
    }

    public function reset(): void
    {
        $this->position = 0;
    }
}

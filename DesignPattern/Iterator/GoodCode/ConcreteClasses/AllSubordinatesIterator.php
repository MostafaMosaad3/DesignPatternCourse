<?php

namespace DesignPattern\Iterator\GoodCode\ConcreteClasses;

use DesignPattern\Iterator\GoodCode\Contracts\EmployeeIterator;
use DesignPattern\Iterator\GoodCode\Employee;

class AllSubordinatesIterator implements EmployeeIterator
{
    private $allEmployees = [];
    private $position = 0;

    public function __construct(Employee $root)
    {
        $this->collectAllEmployees($root);
    }

    private function collectAllEmployees(Employee $employee): void
    {
        $subordinates = $employee->getSubordinatesArray();

        foreach ($subordinates as $subordinate) {
            $this->allEmployees[] = $subordinate;
            $this->collectAllEmployees($subordinate); // Recursive
        }
    }

    public function hasNext(): bool
    {
        return $this->position < count($this->allEmployees);
    }

    public function next(): ?Employee
    {
        if (!$this->hasNext()) {
            return null;
        }
        return $this->allEmployees[$this->position++];
    }

    public function current(): ?Employee
    {
        return $this->allEmployees[$this->position] ?? null;
    }

    public function reset(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->allEmployees);
    }
}

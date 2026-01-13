<?php

namespace DesignPattern\Iterator\GoodCode\ConcreteClasses;

use DesignPattern\Iterator\GoodCode\Contracts\EmployeeIterator;

class DirectReportsIterator implements EmployeeIterator
{
    private $employees;
    private $position = 0;

    public function __construct(array $employees)
    {
        $this->employees = $employees;
    }

    public function hasNext(): bool
    {
        return $this->position < count($this->employees);
    }

    public function next(): ?\DesignPattern\Iterator\GoodCode\Employee
    {
        if (!$this->hasNext()) {
            return null;
        }
        return $this->employees[$this->position++];
    }

    public function current(): ?\DesignPattern\Iterator\GoodCode\Employee
    {
        return $this->employees[$this->position] ?? null;
    }

    public function reset(): void
    {
        $this->position = 0;
    }

    public function count(): int
    {
        return count($this->employees);
    }

}

<?php

namespace DesignPattern\Iterator\GoodCode\Contracts;

use DesignPattern\Iterator\GoodCode\Employee;

interface EmployeeIterator
{
    public function hasNext(): bool;
    public function next(): ?Employee;
    public function current(): ?Employee;
    public function reset(): void;
}

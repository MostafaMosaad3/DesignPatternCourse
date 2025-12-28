<?php

namespace DesignPattern\Iterator\GoodCode;

// ============================================
// GOOD CODE: WITH ITERATOR PATTERN (CONCRETE)
// ============================================
use DesignPattern\Iterator\GoodCode\ConcreteClasses\AllSubordinatesIterator;
use DesignPattern\Iterator\GoodCode\ConcreteClasses\DepartmentFilterIterator;
use DesignPattern\Iterator\GoodCode\ConcreteClasses\DirectReportsIterator;
use DesignPattern\Iterator\GoodCode\Contracts\EmployeeCollection;
use DesignPattern\Iterator\GoodCode\Contracts\EmployeeIterator;

/**
 * BENEFITS:
 * ✅ Employee class: Only 3 simple methods
 * ✅ Iterators: Handle ALL traversal logic
 * ✅ Clean separation of concerns
 * ✅ Easy to change storage
 * ✅ Easy to add new traversal methods
 * ✅ No code duplication
 * ✅ Works with foreach automatically
 */
class Employee implements EmployeeCollection
{
    private $id;
    private $name;
    private $position;
    private $department;
    private $subordinates = []; // ✅ PRIVATE! Encapsulated

    public function __construct(int $id, string $name, string $position, string $department)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->department = $department;
    }

    public function addSubordinate(Employee $employee): void
    {
        $this->subordinates[] = $employee;
    }

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPosition(): string { return $this->position; }
    public function getDepartment(): string { return $this->department; }

    /**
     * ✅ GOOD: Returns iterator instead of array
     * Client doesn't know about internal structure
     */
    public function createIterator(): EmployeeIterator
    {
        return new DirectReportsIterator($this->subordinates);
    }

    /**
     * ✅ GOOD: Get direct reports iterator
     */
    public function getDirectReports(): DirectReportsIterator
    {
        return new DirectReportsIterator($this->subordinates);
    }

    /**
     * ✅ GOOD: Get all subordinates (recursive) iterator
     */
    public function getAllSubordinates(): AllSubordinatesIterator
    {
        return new AllSubordinatesIterator($this);
    }

    /**
     * ✅ GOOD: Filter by department - returns iterator
     */
    public function getSubordinatesByDepartment(string $department): DepartmentFilterIterator
    {
        return new DepartmentFilterIterator($this, $department);
    }


    /**
     * ✅ For iterators to access subordinates
     * Package-private (only iterators use this)
     */
    public function getSubordinatesArray(): array
    {
        return $this->subordinates;
    }
}

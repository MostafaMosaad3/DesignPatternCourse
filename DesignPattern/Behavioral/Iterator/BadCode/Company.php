<?php

namespace DesignPattern\Iterator\BadCode;

class Company
{
    private $employees = [];
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }

    /**
     * ❌ BAD: Returns array directly
     */
    public function getAllEmployees(): array
    {
        return $this->employees;
    }

    /**
     * ❌ BAD: Filter by department
     * Traversal logic HERE too!
     */
    public function getEmployeesByDepartment(string $department): array
    {
        $filtered = [];

        foreach ($this->employees as $employee) {
            if ($employee->getDepartment() === $department) {
                $filtered[] = $employee;
            }
        }

        return $filtered;
    }

    /**
     * ❌ BAD: Filter by position
     * More duplication!
     */
    public function getEmployeesByPosition(string $position): array
    {
        $filtered = [];

        foreach ($this->employees as $employee) {
            if ($employee->getPosition() === $position) {
                $filtered[] = $employee;
            }
        }

        return $filtered;
    }

    /**
     * ❌ BAD: Search by name
     */
    public function findEmployeeByName(string $name): ?Employee
    {
        foreach ($this->employees as $employee) {
            if ($employee->getName() === $name) {
                return $employee;
            }
        }

        return null;
    }

    /**
     * ❌ BAD: Get total employee count
     */
    public function getTotalEmployeeCount(): int
    {
        return count($this->employees);
    }

}

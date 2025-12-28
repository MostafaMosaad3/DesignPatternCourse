<?php

namespace DesignPattern\Iterator\BadCode;

class Department
{
    private $name;
    private $employees = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }

    /**
     * ❌ BAD: Returns array
     * Same problems as above
     */
    public function getEmployees(): array
    {
        return $this->employees;
    }

    /**
     * ❌ BAD: Filter by position
     * Duplicated logic from Company class!
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
     * ❌ BAD: Get managers only
     * More specific filtering
     */
    public function getManagers(): array
    {
        $managers = [];

        foreach ($this->employees as $employee) {
            if (strpos($employee->getPosition(), 'Manager') !== false) {
                $managers[] = $employee;
            }
        }

        return $managers;
    }
}

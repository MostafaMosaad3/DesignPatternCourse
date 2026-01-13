<?php

namespace DesignPattern\Iterator\BadCode;

// ============================================
// BAD CODE: WITHOUT ITERATOR PATTERN
// ============================================

/**
 * PROBLEMS WITH THIS CODE:
 * ❌ Exposes internal structure (array)
 * ❌ Client must know HOW data is stored
 * ❌ Hard to change storage (from array to tree, etc.)
 * ❌ No abstraction for traversal
 * ❌ Tight coupling between client and collection
 * ❌ Can't have multiple traversal methods easily
 * ❌ Client code is messy and repetitive
 * ❌ Violates encapsulation
 */

class Employee
{
    private $id ;
    private $name ;
    private $position ;
    private $department ;
    private $subordinates = [];


    public function __construct($id, $name, $position, $department, $subordinates)
    {
        $this->id = $id;
        $this->name = $name;
        $this->position = $position;
        $this->department = $department;
    }


    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPosition(): string { return $this->position; }
    public function getDepartment(): string { return $this->department; }



    /**
     * ❌ BAD: Returns array directly
     * Exposes that we use array internally
     * Client code depends on array structure
     */
    public function getDirectReports(): array
    {
        return $this->subordinates;
    }


    /**
     * ❌ BAD: Must implement traversal logic HERE
     * This should not be Employee's responsibility!
     */
    public function getAllSubordinates(): array
    {
        $all = [];

        foreach ($this->subordinates as $subordinate) {
            $all[] = $subordinate;
            // ❌ Recursive call - complex logic in wrong place
            $all = array_merge($all, $subordinate->getAllSubordinates());
        }

        return $all;
    }


    /**
     * ❌ BAD: Must implement filtering HERE
     * Yet another responsibility!
     */
    public function getSubordinatesByDepartment(string $department): array
    {
        $filtered = [];

        // ❌ Duplicate traversal logic
        foreach ($this->subordinates as $subordinate) {
            if ($subordinate->getDepartment() === $department) {
                $filtered[] = $subordinate;
            }
            // ❌ Recursive again
            $filtered = array_merge($filtered, $subordinate->getSubordinatesByDepartment($department));
        }

        return $filtered;
    }


    /**
     * ❌ BAD: Must implement ANOTHER traversal method
     * Code keeps growing!
     */
    public function getSubordinatesByPosition(string $position): array
    {
        $filtered = [];

        // ❌ Same logic, different filter
        foreach ($this->subordinates as $subordinate) {
            if ($subordinate->getPosition() === $position) {
                $filtered[] = $subordinate;
            }
            $filtered = array_merge($filtered, $subordinate->getSubordinatesByPosition($position));
        }

        return $filtered;
    }


    /**
     * ❌ BAD: Level-order traversal
     * Even more complex logic in Employee class!
     */
    public function getSubordinatesByLevel(): array
    {
        $result = [];
        $queue = $this->subordinates; // ❌ Directly using array

        while (!empty($queue)) {
            $current = array_shift($queue);
            $result[] = $current;

            // ❌ More array manipulation
            foreach ($current->subordinates as $sub) {
                $queue[] = $sub;
            }
        }

        return $result;
    }


    /**
     * ❌ BAD: Count subordinates
     * Duplicates traversal logic AGAIN
     */
    public function countAllSubordinates(): int
    {
        $count = count($this->subordinates);

        foreach ($this->subordinates as $subordinate) {
            $count += $subordinate->countAllSubordinates();
        }

        return $count;
    }

    /**
     * ❌ BAD: Check if employee has subordinate
     * More traversal logic duplication
     */
    public function hasSubordinate(int $employeeId): bool
    {
        foreach ($this->subordinates as $subordinate) {
            if ($subordinate->getId() === $employeeId) {
                return true;
            }
            if ($subordinate->hasSubordinate($employeeId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * ❌ BAD: Get employee at specific depth
     * Yet another traversal method!
     */
    public function getSubordinatesAtDepth(int $depth): array
    {
        if ($depth === 1) {
            return $this->subordinates;
        }

        $result = [];
        foreach ($this->subordinates as $subordinate) {
            $result = array_merge($result, $subordinate->getSubordinatesAtDepth($depth - 1));
        }

        return $result;
    }

}


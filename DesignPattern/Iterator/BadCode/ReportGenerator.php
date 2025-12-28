<?php

namespace DesignPattern\Iterator\BadCode;

class ReportGenerator
{
    public function generateHierarchyReport(Employee $employee) : string
    {
        $report = "Employee: " . $employee->getName() . "\n";

        // ❌ Uses array directly
        $subordinates = $employee->getDirectReports();

        if (!empty($subordinates)) {
            $report .= "Direct Reports:\n";
            foreach ($subordinates as $sub) {
                $report .= "  - " . $sub->getName() . "\n";
            }
        }

        return $report;
    }

    /**
     * ❌ BAD: Duplicates traversal logic AGAIN
     */
    public function generateFullHierarchyReport(Employee $employee): string
    {
        $report = $employee->getName() . " (" . $employee->getPosition() . ")\n";

        // ❌ Must use array methods
        $subordinates = $employee->getDirectReports();

        foreach ($subordinates as $subordinate) {
            // ❌ Recursive - same logic as in Employee class
            $report .= "  " . $this->generateFullHierarchyReport($subordinate);
        }

        return $report;
    }

    /**
     * ❌ BAD: Department report
     */
    public function generateDepartmentReport(Company $company, string $department): string
    {
        $report = "Department: $department\n";

        // ❌ Gets array, must iterate manually
        $employees = $company->getEmployeesByDepartment($department);

        foreach ($employees as $employee) {
            $report .= "- " . $employee->getName() . "\n";
        }

        return $report;
    }

}

/**
 * ============================================
 * PROBLEMS WITH THIS CONCRETE IMPLEMENTATION:
 * ============================================
 *
 * 1. EMPLOYEE CLASS HAS 10+ METHODS:
 *    ❌ getDirectReports()
 *    ❌ getAllSubordinates()
 *    ❌ getSubordinatesByDepartment()
 *    ❌ getSubordinatesByPosition()
 *    ❌ getSubordinatesByLevel()
 *    ❌ countAllSubordinates()
 *    ❌ hasSubordinate()
 *    ❌ getSubordinatesAtDepth()
 *
 *    THIS IS INSANE! Employee class is doing TOO MUCH!
 *
 * 2. CODE DUPLICATION:
 *    ❌ foreach loop repeated 8+ times
 *    ❌ Recursive logic repeated 5+ times
 *    ❌ Array traversal in Employee, Company, Department
 *    ❌ Same filtering logic in multiple places
 *
 * 3. VIOLATES SINGLE RESPONSIBILITY:
 *    ❌ Employee should manage employee data
 *    ❌ Instead it also:
 *        - Traverses hierarchies
 *        - Filters by department
 *        - Filters by position
 *        - Counts subordinates
 *        - Searches subordinates
 *        - Level-order traversal
 *
 * 4. HARD TO MAINTAIN:
 *    ❌ Need new traversal method? Add to Employee class
 *    ❌ Employee class keeps growing
 *    ❌ 500+ lines for one class
 *    ❌ Hard to test
 *
 * 5. TIGHT COUPLING:
 *    ❌ ReportGenerator knows about arrays
 *    ❌ Company knows about arrays
 *    ❌ Department knows about arrays
 *    ❌ Everyone depends on array implementation
 *
 * 6. CANNOT CHANGE STORAGE:
 *    ❌ Want to use database?
 *        → Must rewrite ALL methods in Employee
 *        → Must rewrite ALL methods in Company
 *        → Must rewrite ALL methods in Department
 *        → Must rewrite ALL methods in ReportGenerator
 *    ❌ Want to use tree structure?
 *        → Same problem!
 *    ❌ 100+ methods to update!
 *
 * 7. NO FLEXIBILITY:
 *    ❌ Want breadth-first traversal? Add method
 *    ❌ Want depth-first traversal? Add method
 *    ❌ Want filter by age? Add method
 *    ❌ Want filter by salary? Add method
 *    ❌ Class explodes with methods!
 *
 * 8. PERFORMANCE ISSUES:
 *    ❌ getAllSubordinates() returns ENTIRE array
 *    ❌ Loads everything in memory
 *    ❌ Can't process one at a time
 *    ❌ Large hierarchies = memory problems
 *
 * 9. CLIENT CODE GETS ARRAYS:
 *    ❌ $employees = $ceo->getDirectReports(); // array
 *    ❌ Client can do: $employees[0] = null; // break things
 *    ❌ Client can do: unset($employees[2]); // modify array
 *    ❌ No protection
 *
 * 10. EVERY NEW FEATURE = NEW METHOD:
 *     ❌ Boss: "Get employees hired this year"
 *         → Add getSubordinatesHiredThisYear()
 *     ❌ Boss: "Get employees over 30"
 *         → Add getSubordinatesOver30()
 *     ❌ Boss: "Get senior developers"
 *         → Add getSeniorDevelopers()
 *
 *     Employee class grows to 2000+ lines!
 *
 * ============================================
 * REAL EXAMPLE OF THE PAIN:
 * ============================================
 *
 * SCENARIO: Need to change from array to database
 *
 * Current code:
 * private $subordinates = []; // Array
 *
 * New requirement:
 * Store in database, load on demand
 *
 * MUST CHANGE:
 * ❌ Employee->getDirectReports()
 * ❌ Employee->getAllSubordinates()
 * ❌ Employee->getSubordinatesByDepartment()
 * ❌ Employee->getSubordinatesByPosition()
 * ❌ Employee->getSubordinatesByLevel()
 * ❌ Employee->countAllSubordinates()
 * ❌ Employee->hasSubordinate()
 * ❌ Employee->getSubordinatesAtDepth()
 * ❌ Company->getAllEmployees()
 * ❌ Company->getEmployeesByDepartment()
 * ❌ Company->getEmployeesByPosition()
 * ❌ Department->getEmployees()
 * ❌ Department->getEmployeesByPosition()
 * ❌ ReportGenerator->generateHierarchyReport()
 * ❌ ReportGenerator->generateFullHierarchyReport()
 *
 * 15+ METHODS TO REWRITE! 😱
 *
 * ============================================
 * SOLUTION: USE ITERATOR PATTERN!
 * ============================================
 *
 * With Iterator Pattern:
 * ✅ Employee class: Only data management
 * ✅ Iterator classes: Handle traversal
 * ✅ One method: getIterator()
 * ✅ Change storage? Update iterator only
 * ✅ Add traversal? Create new iterator
 * ✅ Clean, maintainable, flexible
 *
 * See GOOD CODE for proper implementation!
 */

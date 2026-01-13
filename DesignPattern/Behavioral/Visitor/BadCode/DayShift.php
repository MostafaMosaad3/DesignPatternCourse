<?php

namespace DesignPattern\Visitor\BadCode;

// ============================================
// BAD CODE: WITHOUT VISITOR PATTERN
// ============================================

/**
 * PROBLEMS WITH THIS CODE:
 * ❌ Must modify schedule classes for each new operation
 * ❌ Violates Open/Closed Principle
 * ❌ Violates Single Responsibility (schedules do too much)
 * ❌ Hard to add new operations (risky in production)
 * ❌ Operations scattered across classes
 * ❌ Can't add features without touching production code
 * ❌ Testing is harder (coupled logic)
 * ❌ Code duplication across schedule types
 */


class DayShift
{
    private $employeeName;
    private $startTime;
    private $endTime;
    private $regularHours;
    private $overtimeHours;

    public function __construct(String $employeeName)
    {
        $this->employeeName = $employeeName;
        $this->startTime = '08:00';
        $this->endTime = '17:00';
        $this->regularHours = 8;
        $this->overtimeHours = 0;
    }


    public function setOvertimeHours(Float $hours)
    {
        $this->overtimeHours = $hours;
    }


    /**
     * ❌ BAD: Report generation logic INSIDE schedule class
     * ❌ PROBLEM: Want to add new report format? Must modify this class!
     */
    public function generateReport() :array
    {
        return [
            'type' => 'Day Shift',
            'employee' => $this->employeeName,
            'schedule' => $this->startTime . ' - ' . $this->endTime,
            'hours' => $this->regularHours,
            'overtime' => $this->overtimeHours,
            'total_hours' => $this->regularHours + $this->overtimeHours
        ];
    }

    /**
     * ❌ BAD: Overtime calculation logic INSIDE schedule class
     * ❌ PROBLEM: Want to change calculation? Must modify production code!
     */
    public function calculateOvertime(): float
    {
        $hourlyRate = 20;
        $overtimeMultiplier = 1.5;

        $regularPay = $this->regularHours * $hourlyRate;
        $overtimePay = $this->overtimeHours * $hourlyRate * $overtimeMultiplier;

        return $regularPay + $overtimePay;
    }


    /**
     * ❌ NEW REQUIREMENT: Handle leave requests
     * ❌ PROBLEM: Must add this method to EXISTING production class!
     * ❌ RISK: Might break existing functionality
     */

    public function processLeaveRequest(string $leaveType, int $days): array
    {
        $maxLeaveDays = 20; // Day shift standard

        if ($days > $maxLeaveDays) {
            return [
                'approved' => false,
                'reason' => 'Exceeds maximum leave days'
            ];
        }

        return [
            'approved' => true,
            'employee' => $this->employeeName,
            'type' => $leaveType,
            'days' => $days,
            'remaining' => $maxLeaveDays - $days
        ];
    }
}

/**
 * ============================================
 * PROBLEMS SUMMARY:
 * ============================================
 *
 * 1. VIOLATES OPEN/CLOSED PRINCIPLE:
 *    ❌ Need new operation? Must modify EACH schedule class
 *    ❌ Classes are NOT closed for modification
 *    ❌ Changes to production code = RISK
 *
 * 2. VIOLATES SINGLE RESPONSIBILITY:
 *    ❌ DayShift does:
 *        - Manages schedule data
 *        - Generates reports
 *        - Calculates overtime
 *        - Processes leave requests
 *    ❌ Should only manage schedule data!
 *
 * 3. MASSIVE CODE DUPLICATION:
 *    ❌ generateReport() duplicated 3 times
 *    ❌ calculateOvertime() duplicated 3 times
 *    ❌ processLeaveRequest() duplicated 3 times
 *    ❌ Any bug = must fix in 3 places!
 *
 * 4. HARD TO ADD NEW OPERATIONS:
 *    ❌ Want to add "export to PDF"?
 *        → Must add method to DayShift
 *        → Must add method to NightShift
 *        → Must add method to RemoteWork
 *        → THREE changes to production code!
 *
 * 5. PRODUCTION RISK:
 *    ❌ These classes are in production
 *    ❌ Every change risks breaking existing features
 *    ❌ Must re-test everything after each addition
 *
 * 6. MAINTENANCE NIGHTMARE:
 *    ❌ Want to change overtime calculation?
 *        → Update DayShift.calculateOvertime()
 *        → Update NightShift.calculateOvertime()
 *        → Update RemoteWork.calculateOvertime()
 *    ❌ Easy to forget one and cause inconsistency
 *
 * 7. TESTING DIFFICULTIES:
 *    ❌ Can't test "report generation" separately
 *    ❌ Can't test "overtime calculation" separately
 *    ❌ Must test entire schedule class for each feature
 *    ❌ Coupled logic makes mocking hard
 *
 * 8. RELATED OPERATIONS SCATTERED:
 *    ❌ All "report" logic spread across 3 classes
 *    ❌ All "overtime" logic spread across 3 classes
 *    ❌ All "leave" logic spread across 3 classes
 *    ❌ Hard to understand one operation as a whole
 *
 * 9. REAL-WORLD SCENARIO:
 *
 *    Manager: "Add email notifications for overtime"
 *
 *    Developer must:
 *    ❌ Modify DayShift (add sendOvertimeEmail method)
 *    ❌ Modify NightShift (add sendOvertimeEmail method)
 *    ❌ Modify RemoteWork (add sendOvertimeEmail method)
 *    ❌ Test all three classes
 *    ❌ Deploy changes to production code
 *    ❌ Risk: Might break existing overtime calculations!
 *
 * 10. IMPOSSIBLE TO EXTEND WITHOUT RISK:
 *     ❌ Can't add operations without touching classes
 *     ❌ Every addition = potential breaking change
 *     ❌ No safe way to extend in production
 *
 * ============================================
 * SPECIFIC PROBLEMS:
 * ============================================
 *
 * PROBLEM 1: Adding 4th Schedule Type
 * Want to add "HybridShift"?
 * ❌ Must implement all 3+ methods
 * ❌ Easy to forget one
 * ❌ No compiler check
 *
 * PROBLEM 2: Changing Report Format
 * Want JSON instead of array?
 * ❌ Change generateReport() in 3 places
 * ❌ Must stay consistent
 * ❌ High chance of mistakes
 *
 * PROBLEM 3: Multiple Report Formats
 * Want both array AND JSON?
 * ❌ generateReportArray() + generateReportJSON()
 * ❌ 2 methods × 3 classes = 6 changes
 * ❌ Explosion of methods!
 *
 * PROBLEM 4: Conditional Logic
 * What if operation depends on schedule type?
 * ❌ Lots of if/switch statements
 * ❌ Scattered across codebase
 * ❌ Hard to maintain
 *
 * ============================================
 * SOLUTION: USE VISITOR PATTERN!
 * ============================================
 *
 * With Visitor Pattern:
 * ✅ Schedule classes stay unchanged (stable)
 * ✅ Each operation in separate visitor class
 * ✅ Add operation = create new visitor (no changes to schedules)
 * ✅ Related logic together (all reports in one class)
 * ✅ Production-safe (zero risk to schedule classes)
 * ✅ Easy to test (test visitors independently)
 * ✅ No code duplication
 * ✅ Open/Closed Principle followed
 *
 * See GOOD CODE for proper implementation!
 */

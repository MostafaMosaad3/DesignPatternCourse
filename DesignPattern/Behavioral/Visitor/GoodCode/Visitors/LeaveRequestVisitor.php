<?php

namespace DesignPattern\Visitor\GoodCode\Visitors;

use DesignPattern\Visitor\GoodCode\Contracts\ScheduleVisitor;
use DesignPattern\Visitor\GoodCode\DayShift;
use DesignPattern\Visitor\GoodCode\NightShift;
use DesignPattern\Visitor\GoodCode\RemoteWork;

/**
 * VISITOR 3: Leave Request Manager
 * ✅ NEW FEATURE: Added without touching schedule classes!
 * ✅ All leave logic in ONE place
 */
class LeaveRequestVisitor implements ScheduleVisitor
{
    private $leaveType;
    private $days;

    public function __construct(string $leaveType, int $days)
    {
        $this->leaveType = $leaveType;
        $this->days = $days;
    }

    public function visitDayShift(DayShift $dayShift): array
    {
        $maxLeaveDays = 20;

        if ($this->days > $maxLeaveDays) {
            return [
                'approved' => false,
                'reason' => 'Exceeds maximum leave days'
            ];
        }

        return [
            'approved' => true,
            'employee' => $dayShift->getEmployeeName(),
            'type' => $this->leaveType,
            'days' => $this->days,
            'remaining' => $maxLeaveDays - $this->days
        ];
    }

    public function visitNightShift(NightShift $nightShift): array
    {
        $maxLeaveDays = 25; // Night shift gets more

        if ($this->days > $maxLeaveDays) {
            return [
                'approved' => false,
                'reason' => 'Exceeds maximum leave days'
            ];
        }

        return [
            'approved' => true,
            'employee' => $nightShift->getEmployeeName(),
            'type' => $this->leaveType,
            'days' => $this->days,
            'remaining' => $maxLeaveDays - $this->days
        ];
    }

    public function visitRemoteWork(RemoteWork $remoteWork): array
    {
        $maxLeaveDays = 30; // Remote workers get most

        if ($this->days > $maxLeaveDays) {
            return [
                'approved' => false,
                'reason' => 'Exceeds maximum leave days'
            ];
        }

        return [
            'approved' => true,
            'employee' => $remoteWork->getEmployeeName(),
            'type' => $this->leaveType,
            'days' => $this->days,
            'remaining' => $maxLeaveDays - $this->days
        ];
    }
}

/**
 * ============================================
 * ADVANTAGES OF THIS APPROACH:
 * ============================================
 *
 * 1. ZERO CHANGES TO SCHEDULE CLASSES:
 *    ✅ DayShift, NightShift, RemoteWork UNCHANGED
 *    ✅ Only added accept() method once (during initial design)
 *    ✅ Production-safe: No risk to existing code
 *
 * 2. EASY TO ADD NEW OPERATIONS:
 *    ✅ Want to add "Email Notification"?
 *        - Create EmailNotificationVisitor
 *        - Implement 3 visit methods
 *        - That's it! No changes to schedules
 *    ✅ Want to add "Export to PDF"?
 *        - Create PdfExportVisitor
 *        - Done! Schedules stay same
 *
 * 3. NO CODE DUPLICATION:
 *    ✅ All report logic in ReportGeneratorVisitor
 *    ✅ All overtime logic in OvertimeCalculatorVisitor
 *    ✅ All leave logic in LeaveRequestVisitor
 *    ✅ ONE place for each operation
 *
 * 4. RELATED OPERATIONS TOGETHER:
 *    ✅ All reports in one class (easy to find/modify)
 *    ✅ All overtime in one class
 *    ✅ All leave in one class
 *    ✅ Clear organization
 *
 * 5. EASY TO TEST:
 *    ✅ Test ReportGeneratorVisitor independently
 *    ✅ Test OvertimeCalculatorVisitor independently
 *    ✅ Mock schedules easily
 *    ✅ Test one operation at a time
 *
 * 6. FOLLOWS SOLID PRINCIPLES:
 *    ✅ Single Responsibility (each class one job)
 *    ✅ Open/Closed (open for extension, closed for modification)
 *    ✅ Dependency Inversion (depend on interfaces)
 *
 * 7. TYPE-SAFE:
 *    ✅ Compiler ensures all visit methods exist
 *    ✅ Can't forget to handle a schedule type
 *    ✅ Clear which operation for which schedule
 *
 * ============================================
 * ADDING NEW OPERATION - EXAMPLE:
 * ============================================
 *
 * Want to add "Email Notification" feature?
 *
 * class EmailNotificationVisitor implements ScheduleVisitor
 * {
 *     public function visitDayShift(DayShift $shift) {
 *         // Send email for day shift
 *         return "Email sent to " . $shift->getEmployeeName();
 *     }
 *
 *     public function visitNightShift(NightShift $shift) {
 *         // Send email for night shift
 *         return "Email sent to " . $shift->getEmployeeName();
 *     }
 *
 *     public function visitRemoteWork(RemoteWork $work) {
 *         // Send email for remote work
 *         return "Email sent to " . $work->getEmployeeName();
 *     }
 * }
 *
 * // Usage:
 * $emailVisitor = new EmailNotificationVisitor();
 * $dayShift->accept($emailVisitor);
 *
 * ✅ NO changes to schedule classes!
 * ✅ Just create new visitor
 * ✅ Production-safe!
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * Adding "Email Notification" feature:
 *
 * BAD CODE:
 * ❌ Add sendEmail() to DayShift
 * ❌ Add sendEmail() to NightShift
 * ❌ Add sendEmail() to RemoteWork
 * ❌ THREE changes to production classes
 * ❌ Risk breaking existing features
 * ❌ Must re-test everything
 *
 * GOOD CODE:
 * ✅ Create EmailNotificationVisitor
 * ✅ Implement 3 visit methods
 * ✅ ZERO changes to schedule classes
 * ✅ No risk to production code
 * ✅ Only test new visitor
 *
 * ============================================
 * ADDING NEW SCHEDULE TYPE:
 * ============================================
 *
 * Want to add "HybridShift"?
 *
 * 1. Create HybridShift class:
 * class HybridShift implements Schedule {
 *     public function accept(ScheduleVisitor $visitor) {
 *         return $visitor->visitHybridShift($this);
 *     }
 * }
 *
 * 2. Update ScheduleVisitor interface:
 * interface ScheduleVisitor {
 *     // ... existing methods
 *     public function visitHybridShift(HybridShift $shift);
 * }
 *
 * 3. Update all existing visitors:
 * ❌ Must add visitHybridShift() to each visitor
 *
 * This is the ONE drawback of Visitor Pattern:
 * - Easy to add operations (just new visitor)
 * - Hard to add element types (update all visitors)
 *
 * USE VISITOR WHEN:
 * ✅ Element types are stable (don't change often)
 * ✅ Operations change/grow frequently
 *
 * ============================================
 * REAL-WORLD BENEFITS:
 * ============================================
 *
 * Scenario: Manager asks for new feature
 *
 * BEFORE (Bad Code):
 * 😰 "We need to modify production code..."
 * 😰 "This might break existing features..."
 * 😰 "We need extensive testing..."
 * 😰 "Deploy date uncertain..."
 *
 * AFTER (Good Code):
 * 😊 "Just create a new visitor!"
 * 😊 "No changes to existing code!"
 * 😊 "Only test the new visitor!"
 * 😊 "Can deploy safely anytime!"
 *
 * That's the power of Visitor Pattern! 🚀
 */

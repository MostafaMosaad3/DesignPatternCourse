<?php

namespace DesignPattern\Visitor\GoodCode\Contracts;

// ============================================
// STEP 2: SCHEDULE INTERFACE (Element)
// ============================================

/**
 * All schedules must implement accept() method
 * This enables the visitor pattern
 */

interface Schedule
{
    public function accept(ScheduleVisitor $visitor);
}

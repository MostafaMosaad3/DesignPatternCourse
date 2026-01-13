<?php

namespace DesignPattern\Visitor\GoodCode\Visitors;

use DesignPattern\Visitor\GoodCode\Contracts\ScheduleVisitor;
use DesignPattern\Visitor\GoodCode\DayShift;
use DesignPattern\Visitor\GoodCode\NightShift;
use DesignPattern\Visitor\GoodCode\RemoteWork;

// ============================================
// STEP 4: CONCRETE VISITORS (Operations)
// ============================================

/**
 * VISITOR 1: Report Generator
 * ✅ All report logic in ONE place
 */


class ReportGeneratorVisitor implements ScheduleVisitor
{
    public function visitDayShift(DayShift $dayShift): array
    {
        return [
            'type' => 'Day Shift',
            'employee' => $dayShift->getEmployeeName(),
            'schedule' => $dayShift->getStartTime() . ' - ' . $dayShift->getEndTime(),
            'hours' => $dayShift->getRegularHours(),
            'overtime' => $dayShift->getOvertimeHours(),
            'total_hours' => $dayShift->getRegularHours() + $dayShift->getOvertimeHours()
        ];
    }

    public function visitNightShift(NightShift $nightShift): array
    {
        return [
            'type' => 'Night Shift',
            'employee' => $nightShift->getEmployeeName(),
            'schedule' => $nightShift->getStartTime() . ' - ' . $nightShift->getEndTime(),
            'hours' => $nightShift->getRegularHours(),
            'overtime' => $nightShift->getOvertimeHours(),
            'total_hours' => $nightShift->getRegularHours() + $nightShift->getOvertimeHours(),
            'night_bonus' => 'Included'
        ];
    }

    public function visitRemoteWork(RemoteWork $remoteWork): array
    {
        return [
            'type' => 'Remote Work',
            'employee' => $remoteWork->getEmployeeName(),
            'schedule' => 'Flexible',
            'hours' => $remoteWork->getHoursLogged(),
            'overtime' => $remoteWork->getOvertimeHours(),
            'total_hours' => $remoteWork->getHoursLogged()
        ];
    }
}

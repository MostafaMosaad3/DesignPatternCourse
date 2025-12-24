<?php

namespace DesignPattern\Visitor\GoodCode\Visitors;


use DesignPattern\Visitor\GoodCode\Contracts\ScheduleVisitor;
use DesignPattern\Visitor\GoodCode\DayShift;
use DesignPattern\Visitor\GoodCode\NightShift;
use DesignPattern\Visitor\GoodCode\RemoteWork;

/**
 * VISITOR 2: Overtime Calculator
 * ✅ All overtime logic in ONE place
 */
class OvertimeCalculatorVisitor implements ScheduleVisitor
{
    public function visitDayShift(DayShift $dayShift): float
    {
        $hourlyRate = 20;
        $overtimeMultiplier = 1.5;

        $regularPay = $dayShift->getRegularHours() * $hourlyRate;
        $overtimePay = $dayShift->getOvertimeHours() * $hourlyRate * $overtimeMultiplier;

        return $regularPay + $overtimePay;
    }

    public function visitNightShift(NightShift $nightShift): float
    {
        $hourlyRate = 20;
        $overtimeMultiplier = 2.0; // Higher for night
        $nightBonus = 5;

        $regularPay = $nightShift->getRegularHours() * ($hourlyRate + $nightBonus);
        $overtimePay = $nightShift->getOvertimeHours() * ($hourlyRate + $nightBonus) * $overtimeMultiplier;

        return $regularPay + $overtimePay;
    }

    public function visitRemoteWork(RemoteWork $remoteWork): float
    {
        $hourlyRate = 25; // Remote workers paid more
        $overtimeMultiplier = 1.5;

        $regularHours = $remoteWork->getHoursLogged() - $remoteWork->getOvertimeHours();
        $regularPay = $regularHours * $hourlyRate;
        $overtimePay = $remoteWork->getOvertimeHours() * $hourlyRate * $overtimeMultiplier;

        return $regularPay + $overtimePay;
    }
}

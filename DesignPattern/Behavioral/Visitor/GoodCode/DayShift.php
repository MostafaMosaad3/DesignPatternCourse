<?php

namespace DesignPattern\Visitor\GoodCode;

use DesignPattern\Visitor\GoodCode\Contracts\Schedule;
use DesignPattern\Visitor\GoodCode\Contracts\ScheduleVisitor;

class DayShift implements Schedule
{

    private $employeeName;
    private $startTime = '09:00';
    private $endTime = '17:00';
    private $regularHours = 8;
    private $overtimeHours = 0;

    public function __construct(string $employeeName)
    {
        $this->employeeName = $employeeName;
    }

    public function setOvertimeHours(float $hours): void
    {
        $this->overtimeHours = $hours;
    }

    // ✅ ONLY schedule-related getters (data access)
    public function getEmployeeName(): string { return $this->employeeName; }
    public function getStartTime(): string { return $this->startTime; }
    public function getEndTime(): string { return $this->endTime; }
    public function getRegularHours(): float { return $this->regularHours; }
    public function getOvertimeHours(): float { return $this->overtimeHours; }



    /**
     * ✅ ACCEPT: Enables visitor pattern
     * Calls the appropriate visit method for this type
     */
    public function accept(ScheduleVisitor $visitor)
    {
        return $visitor->visitDayShift($this);
    }
}

<?php

namespace DesignPattern\Visitor\GoodCode;

use DesignPattern\Visitor\GoodCode\Contracts\Schedule;
use DesignPattern\Visitor\GoodCode\Contracts\ScheduleVisitor;

class NightShift implements Schedule
{

    private $employeeName;
    private $startTime = '22:00';
    private $endTime = '06:00';
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

    public function getEmployeeName(): string { return $this->employeeName; }
    public function getStartTime(): string { return $this->startTime; }
    public function getEndTime(): string { return $this->endTime; }
    public function getRegularHours(): float { return $this->regularHours; }
    public function getOvertimeHours(): float { return $this->overtimeHours; }


    public function accept(ScheduleVisitor $visitor)
    {
        return $visitor->visitNightShift($this);
    }
}

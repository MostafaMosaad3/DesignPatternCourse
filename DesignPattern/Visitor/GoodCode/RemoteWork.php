<?php

namespace DesignPattern\Visitor\GoodCode;

use DesignPattern\Visitor\GoodCode\Contracts\Schedule;
use DesignPattern\Visitor\GoodCode\Contracts\ScheduleVisitor;

class RemoteWork implements Schedule
{

    private $employeeName;
    private $hoursLogged = 0;
    private $overtimeHours = 0;

    public function __construct(string $employeeName)
    {
        $this->employeeName = $employeeName;
    }

    public function logHours(float $hours): void
    {
        $this->hoursLogged = $hours;
        if ($hours > 8) {
            $this->overtimeHours = $hours - 8;
        }
    }

    public function getEmployeeName(): string { return $this->employeeName; }
    public function getHoursLogged(): float { return $this->hoursLogged; }
    public function getOvertimeHours(): float { return $this->overtimeHours; }


    public function accept(ScheduleVisitor $visitor)
    {
        return $visitor->visitRemoteWork($this);
    }
}

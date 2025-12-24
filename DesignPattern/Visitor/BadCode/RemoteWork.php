<?php

namespace DesignPattern\Visitor\BadCode;

class RemoteWork
{
    private $employeeName;
    private $hoursLogged;
    private $overtimeHours;

    public function __construct(string $employeeName)
    {
        $this->employeeName = $employeeName;
        $this->hoursLogged = 0;
        $this->overtimeHours = 0;
    }

    public function logHours(float $hours): void
    {
        $this->hoursLogged = $hours;

        if ($hours > 8) {
            $this->overtimeHours = $hours - 8;
        }
    }

    /**
     * ❌ DUPLICATED AGAIN!
     */
    public function generateReport(): array
    {
        return [
            'type' => 'Remote Work',
            'employee' => $this->employeeName,
            'schedule' => 'Flexible',
            'hours' => $this->hoursLogged,
            'overtime' => $this->overtimeHours,
            'total_hours' => $this->hoursLogged
        ];
    }

    /**
     * ❌ DUPLICATED AGAIN with different logic!
     */
    public function calculateOvertime(): float
    {
        $hourlyRate = 25; // Remote workers paid more
        $overtimeMultiplier = 1.5;

        $regularHours = $this->hoursLogged - $this->overtimeHours;
        $regularPay = $regularHours * $hourlyRate;
        $overtimePay = $this->overtimeHours * $hourlyRate * $overtimeMultiplier;

        return $regularPay + $overtimePay;
    }

    /**
     * ❌ THIRD DUPLICATION!
     */
    public function processLeaveRequest(string $leaveType, int $days): array
    {
        $maxLeaveDays = 30; // Remote workers get most leave

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

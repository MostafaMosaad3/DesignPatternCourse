<?php

namespace DesignPattern\Visitor\BadCode;

class NightShift
{
    private $employeeName;
    private $startTime;
    private $endTime;
    private $regularHours;
    private $overtimeHours;

    public function __construct(string $employeeName)
    {
        $this->employeeName = $employeeName;
        $this->startTime = '22:00';
        $this->endTime = '06:00';
        $this->regularHours = 8;
        $this->overtimeHours = 0;
    }

    public function setOvertimeHours(float $hours): void
    {
        $this->overtimeHours = $hours;
    }

    /**
     * ❌ DUPLICATED CODE from DayShift!
     * ❌ Similar but slightly different
     */
    public function generateReport(): array
    {
        return [
            'type' => 'Night Shift',
            'employee' => $this->employeeName,
            'schedule' => $this->startTime . ' - ' . $this->endTime,
            'hours' => $this->regularHours,
            'overtime' => $this->overtimeHours,
            'total_hours' => $this->regularHours + $this->overtimeHours,
            'night_bonus' => 'Included' // Night shift specific
        ];
    }

    /**
     * ❌ DUPLICATED CODE with different calculation
     */
    public function calculateOvertime(): float
    {
        $hourlyRate = 20;
        $overtimeMultiplier = 2.0; // Higher for night shift
        $nightBonus = 5; // Extra per hour

        $regularPay = $this->regularHours * ($hourlyRate + $nightBonus);
        $overtimePay = $this->overtimeHours * ($hourlyRate + $nightBonus) * $overtimeMultiplier;

        return $regularPay + $overtimePay;
    }

    /**
     * ❌ MUST DUPLICATE this method here too!
     */
    public function processLeaveRequest(string $leaveType, int $days): array
    {
        $maxLeaveDays = 25; // Night shift gets more leave

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

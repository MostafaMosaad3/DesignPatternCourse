<?php

namespace DesignPattern\Visitor\GoodCode\Contracts;

// ============================================
// STEP 1: VISITOR INTERFACE
// ============================================
use DesignPattern\Visitor\GoodCode\DayShift;
use DesignPattern\Visitor\GoodCode\NightShift;
use DesignPattern\Visitor\GoodCode\RemoteWork;
use Illuminate\Console\Scheduling\Schedule;

/**
 * Defines operations that can be performed on schedules
 * Each schedule type gets its own visit method
 */

interface ScheduleVisitor
{
    public function visitDayShift(DayShift $dayShift);
    public function visitNightShift(NightShift $nightShift);
    public function visitRemoteWork(RemoteWork $remoteWork);
}

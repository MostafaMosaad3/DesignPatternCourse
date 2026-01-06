<?php

namespace GoodCode;

// ============================================
// 5. INVOKER: REMOTE CONTROL
// ============================================
use DesignPattern\Command\GoodCode\Contract\Command;

/**
 * ✅ GOOD: Remote only knows Command interface
 */

class RemoteControl
{
    private array $commands = [];


    /**
     * ✅ Simple: Just set a command to a button
     */
    public function setCommand(int $button, Command $command): void
    {
        $this->commands[$button] = $command;
    }

    /**
     * ✅ Simple: Execute the command
     */
    public function pressButton(int $button): void
    {
        if (isset($this->commands[$button])) {
            $this->commands[$button]->execute();
            $this->lastCommand = $this->commands[$button];
        } else {
            echo "❌ No command on button {$button}\n";
        }
    }
}


/**
 * ✅ BENEFITS OF THIS APPROACH:
 *
 * 1. LOOSE COUPLING:
 *    ✅ Remote only knows Command interface
 *    ✅ Remote doesn't know about Light, Door, TV
 *    ✅ Can add new devices without changing Remote
 *
 * 2. UNDO SUPPORT:
 *    ✅ Easy to implement undo
 *    ✅ Just call command.undo()
 *    ✅ Commands know how to reverse themselves
 *
 * 3. EASY TO EXTEND:
 *    ✅ Want Thermostat? Create ThermostatCommand
 *    ✅ Want new action? Create new command class
 *    ✅ Follows Open/Closed Principle
 *
 * 4. MACRO COMMANDS:
 *    ✅ Easy to create "Good Night Mode"
 *    ✅ Easy to create "Party Mode"
 *    ✅ Just combine existing commands
 *
 * 5. QUEUING/SCHEDULING:
 *    ✅ Can store commands in array
 *    ✅ Can execute later
 *    ✅ Can schedule for specific time
 *
 * 6. LOGGING:
 *    ✅ Easy to log each command
 *    ✅ Easy to create audit trail
 *    ✅ Can serialize commands
 *
 * 7. TESTING:
 *    ✅ Test commands independently
 *    ✅ Mock receivers easily
 *    ✅ Test remote without real devices
 */

// ============================================
// COMPARISON SUMMARY
// ============================================

/**
 * ============================================
 * WHEN TO USE WHICH APPROACH
 * ============================================
 *
 * USE BAD CODE (Direct calls) WHEN:
 * - Very simple app with 2-3 actions
 * - No need for undo
 * - No need for queuing
 * - Prototype/POC
 * - Requirements won't change
 *
 * USE GOOD CODE (Command Pattern) WHEN:
 * - Need undo/redo
 * - Need queuing/scheduling
 * - Many devices and actions
 * - Requirements may change
 * - Need logging/audit
 * - Need macros/shortcuts
 * - Building scalable system
 * - Multiple invokers (app, voice, schedule)
 */

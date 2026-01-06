<?php

// ============================================
// BAD REMOTE CONTROL
// ============================================

/**
 * ❌ BAD: Remote knows about all devices and their methods
 */

class RemoteControl
{
    private $devices = [] ;


    /**
     * ❌ Remote directly stores device objects
     */

    public function setDevices(int $button, string $type, object $device, string $action): void
    {
        $this->devices[$button] =
        [
            'type' => $type,
            'device' => $device,
            'action' => $action
        ];
    }

    /**
     * ❌ Remote has to know about each device type and action
     */
    public function pressButton(int $button): void
    {
        if (!isset($this->devices[$button])) {
            echo "❌ No device on button {$button}\n";
            return;
        }

        $device = $this->devices[$button]['device'];
        $action = $this->devices[$button]['action'];
        $type = $this->devices[$button]['type'];

        // ❌ Switch statement - violates Open/Closed Principle
        switch ($type) {
            case 'light':
                if ($action === 'on') {
                    $device->turnOn();
                } elseif ($action === 'off') {
                    $device->turnOff();
                }
                break;

            case 'door':
                if ($action === 'lock') {
                    $device->lock();
                } elseif ($action === 'unlock') {
                    $device->unlock();
                }
                break;

            case 'tv':
                if ($action === 'on') {
                    $device->turnTVOn();
                } elseif ($action === 'off') {
                    $device->turnTVOff();
                }
                break;

            default:
                echo "❌ Unknown device type\n";
        }
    }

    /**
     * ❌ IMPOSSIBLE: Can't implement undo without major refactoring
     */
    public function undo(): void
    {
        echo "❌ Undo not supported!\n";
        // How do we know what to undo?
        // Need to store previous state for each device
        // Need to know which device was last used
        // This becomes a nightmare!
    }

}


/**
 * ❌ PROBLEMS WITH THIS APPROACH:
 *
 * 1. TIGHT COUPLING:
 *    - Remote knows about Light, Door, TV classes
 *    - Remote knows about turnOn(), turnOff(), lock(), unlock()
 *    - Adding new device type requires changing Remote class
 *
 * 2. NO UNDO:
 *    - No way to track what was last executed
 *    - No way to reverse operations
 *    - Would need complex state management
 *
 * 3. HARD TO EXTEND:
 *    - Want to add Thermostat? Change Remote class
 *    - Want to add new action? Change Remote class
 *    - Violates Open/Closed Principle
 *
 * 4. NO MACRO COMMANDS:
 *    - Can't easily create "Good Night Mode" (multiple actions)
 *    - Would need separate methods for each scenario
 *
 * 5. NO QUEUING:
 *    - Can't queue commands for later
 *    - Can't schedule commands
 *    - All executes immediately
 *
 * 6. NO LOGGING:
 *    - Hard to log what happened
 *    - Hard to create audit trail
 *
 * 7. TESTING IS HARD:
 *    - Remote is tightly coupled to devices
 *    - Hard to mock or test in isolation
 */

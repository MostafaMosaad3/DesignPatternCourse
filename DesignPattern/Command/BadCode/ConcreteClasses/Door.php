<?php

namespace DesignPattern\Command\BadCode\ConcreteClasses;

// ============================================
// BAD CODE: WITHOUT COMMAND PATTERN
// ============================================

/**
 * PROBLEMS:
 * ❌ Tight coupling between remote and devices
 * ❌ No undo functionality
 * ❌ Hard to add new devices
 * ❌ Hard to add new features (schedule, queue)
 * ❌ Remote knows too much about devices
 * ❌ Can't create macros easily
 * ❌ Can't log or queue operations
 */


class Door
{
    public $location ;
    public $isLocked = false ;

    public function __construct($location)
    {
        $this->location = $location ;
    }

    public function lock(): void
    {
        $this->isLocked = true;
        echo "🔒 {$this->location} door is LOCKED\n";
    }

    public function unlock(): void
    {
        $this->isLocked = false;
        echo "🔓 {$this->location} door is UNLOCKED\n";
    }
}

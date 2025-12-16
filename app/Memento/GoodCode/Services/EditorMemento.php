<?php

namespace App\Memento\GoodCode\Services;

// ============================================
// STEP 1: MEMENTO CLASS
// ============================================

/**
 * Stores a snapshot of editor state
 * - IMMUTABLE (cannot change after creation)
 * - Only TextEditor can read its state
 */
class EditorMemento
{
    private $state ;
    private $timestamp ;


    public function __construct(array $state)
    {
        $this->state = $state;
        $this->timestamp = date('Y-m-d H:i:s');
    }

    /**
     * ✅ GOOD: Only package-level access
     * TextEditor can read, but History cannot
     */

    public function getState(): array
    {
        return $this->state;
    }

    public function getTimestamp(): string
    {
        return $this->timestamp;
    }

}

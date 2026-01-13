<?php

namespace DesignPattern\Command\GoodCode\Contract;

// ============================================
// 1. COMMAND INTERFACE
// ============================================

/**
 * ✅ GOOD: Command interface
 */

interface Command
{
    public function execute();
}

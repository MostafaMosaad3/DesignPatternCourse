<?php

namespace DesignPattern\Creational\Singleton\BadCode;


class Logging
{
    private string $logFile ;
    private string $level ;

    public function __construct()
    {
        $this->logFile = dirname(__DIR__, 2) . '/logs/log.txt';
        $this->level = 'INFO';
    }

    public function setLevel(string $level): void
    {
        $this->level = $level;
    }


    public function canLog(string $messageLevel): bool
    {
        $levels = ['DEBUG' => 0, 'INFO' => 1, 'WARN' => 2, 'ERROR' => 3];
        return $levels[$messageLevel] >= $levels[$this->level];
    }

    public function debug(string $message): void
    {
        if ($this->canLog('DEBUG')) {
            echo "[DEBUG] {$message} → File: {$this->logFile}\n";
        }
    }

    public function info(string $message): void
    {
        if ($this->canLog('INFO')) {
            echo "[INFO] {$message} → File: {$this->logFile}\n";
        }
    }

    public function warn(string $message): void
    {
        if ($this->canLog('WARN')) {
            echo "[WARN] {$message} → File: {$this->logFile}\n";
        }
    }

    public function error(string $message): void
    {
        if ($this->canLog('ERROR')) {
            echo "[ERROR] {$message} → File: {$this->logFile}\n";
        }
    }

}

/*
 * Problems of NOT using Singleton for the Logging class:
 *
 * 1- Multiple Instances: Every time we do `new Logging()`, a new object is created.
 *    This means different parts of the application hold different logger instances,
 *    each with its own separate state (logFile, level).
 *
 * 2- Inconsistent Configuration: If one part of the code calls `setLevel('ERROR')`
 *    and another part creates a new instance, the second instance resets back to 'INFO'.
 *    There is no shared configuration across the application.
 *
 * 3- Wasted Resources: Opening and managing multiple logger objects wastes memory
 *    and resources when a single shared instance would be enough.
 *
 * 4- No Single Source of Truth: Without Singleton, there is no guarantee that all
 *    parts of the application are logging to the same file with the same level.
 *    Each instance acts independently, making debugging and log tracking harder.
 *
 * 5- Hard to Control Access: Anyone can create a new instance at any time.
 *    There is no centralized control over how the logger is created or used.
 */

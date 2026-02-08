<?php

namespace DesignPattern\Creational\Singleton\GoodCode;


class Logging
{
    private static ?Logging $instance = null;

    private string $logFile;
    private string $level;

    // 1- Make the constructor private to prevent `new Logging()` from outside
    private function __construct()
    {
        $this->logFile = dirname(__DIR__, 2) . '/logs/log.txt';
        $this->level = 'INFO';
    }

    // 2- Prevent cloning of the instance
    private function __clone() {}

    // 3- Prevent unserialization of the instance
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a Singleton.");
    }

    // 4- The only way to get the instance is through this static method
    public static function getInstance(): Logging
    {
        if (self::$instance === null) {
            self::$instance = new Logging();
        }
        return self::$instance;
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
 * How Singleton solves the problems:
 *
 * 1- Single Instance: `private __construct()` prevents anyone from doing `new Logging()`.
 *    The only way to get the logger is through `Logging::getInstance()`.
 *
 * 2- Consistent Configuration: Since there is only one instance, calling `setLevel('ERROR')`
 *    affects the entire application. All code shares the same configuration.
 *
 * 3- No Wasted Resources: Only one object is ever created and reused everywhere.
 *
 * 4- Single Source of Truth: Every part of the application uses the exact same logger
 *    with the same logFile and the same level.
 *
 * 5- Controlled Access: `private __clone()` and `__wakeup()` prevent creating copies
 *    through cloning or unserialization. The class fully controls its own instantiation.
 */

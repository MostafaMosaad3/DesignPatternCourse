<?php

namespace DesignPattern\Solid\GoodCode\Contracts;

/**
 * Small interface: only for logging
 */
interface LoggerInterface
{
    public function log(string $message, array $context): void;
}

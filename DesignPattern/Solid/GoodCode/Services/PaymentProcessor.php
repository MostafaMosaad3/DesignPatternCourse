<?php

namespace DesignPattern\Solid\GoodCode\Services;

/**
 * Abstract base class for payment processing
 * New payment types can EXTEND this WITHOUT modifying it
 */
abstract class PaymentProcessor
{
    public $gateway ;

    public function __construct($gateway)
    {
        $this->gateway = $gateway;
    }


    // Template method - defines the structure
    abstract public function process(array $data): array;

    // Hook methods for extension points
    protected function beforeProcess(array $data): void
    {
        // Can be overridden by subclasses
    }

    protected function afterProcess(array $result): void
    {
        // Can be overridden by subclasses
    }

}

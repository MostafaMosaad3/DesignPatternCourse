<?php

namespace DesignPattern\State\GoodCode;

/**
 * STEP 1: Define the State Interface
 *
 * This is the contract that ALL order states must follow
 */
interface OrderState
{
    /**
     * Process the order
     */
    public function process(Order $order): array;

    /**
     * Cancel the order
     */
    public function cancel(Order $order): array;

    /**
     * Ship the order
     */
    public function ship(Order $order): array;

    /**
     * Deliver the order
     */
    public function deliver(Order $order): array;

    /**
     * Get state name
     */
    public function getStateName(): string;
}

/**
 * WHY INTERFACE?
 * - Ensures all states have same methods
 * - Makes states interchangeable
 * - Order can use any state
 * - Follows Dependency Inversion Principle
 */

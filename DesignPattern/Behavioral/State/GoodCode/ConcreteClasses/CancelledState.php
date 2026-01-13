<?php

namespace DesignPattern\State\GoodCode\ConcreteClasses;

use DesignPattern\State\GoodCode\Order;
use DesignPattern\State\GoodCode\OrderState;

/**
 * CONCRETE STATE 5: Cancelled Order State
 *
 * ALLOWED ACTIONS: None (final state)
 * NOT ALLOWED: All actions
 */
class CancelledState implements OrderState
{

    public function process(Order $order): array
    {
        return ['success' => false, 'message' => 'Cannot process cancelled order'];
    }

    public function cancel(Order $order): array
    {
        return ['success' => false, 'message' => 'Order already cancelled'];
    }

    public function ship(Order $order): array
    {
        return ['success' => false, 'message' => 'Cannot ship cancelled order'];
    }

    public function deliver(Order $order): array
    {
        return ['success' => false, 'message' => 'Cannot deliver cancelled order'];
    }

    public function getStateName(): string
    {
        return 'Cancelled';
    }
}

/**
 * KEY POINTS:
 * - Each state class handles ONE state
 * - All implement OrderState interface
 * - All have the same methods
 * - Each has different behavior
 * - States control transitions
 * - Easy to add new states!
 */

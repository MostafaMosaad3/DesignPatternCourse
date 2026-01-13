<?php

namespace DesignPattern\State\GoodCode\ConcreteClasses;

use DesignPattern\State\GoodCode\Order;
use DesignPattern\State\GoodCode\OrderState;

/**
 * CONCRETE STATE 2: Processing Order State
 *
 * ALLOWED ACTIONS: ship(), cancel()
 * NOT ALLOWED: process(), deliver()
 */
class ProcessingState implements OrderState
{

    public function process(Order $order): array
    {
        // Processing order already being processed
        return ['success' => false, 'message' => 'Order is already being processed'];
    }

    public function cancel(Order $order): array
    {
        // Processing order CAN be cancelled
        $order->setState(new CancelledState());
        return ['success' => true, 'message' => 'Order cancelled'];
    }

    public function ship(Order $order): array
    {
        // Processing order CAN be shipped
        $order->setState(new ShippedState());
        return ['success' => true, 'message' => 'Order shipped'];
    }

    public function deliver(Order $order): array
    {
        // Processing order CANNOT be delivered directly
        return ['success' => false, 'message' => 'Cannot deliver unshipped order'];
    }

    public function getStateName(): string
    {
        return 'Processing';
    }
}

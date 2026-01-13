<?php

namespace DesignPattern\State\GoodCode\ConcreteClasses;

use DesignPattern\State\GoodCode\Order;
use DesignPattern\State\GoodCode\OrderState;

/**
 * CONCRETE STATE 1: New Order State
 *
 * ALLOWED ACTIONS: process(), cancel()
 * NOT ALLOWED: ship(), deliver()
 * */
class NewState implements OrderState
{
    public function process(Order $order): array
    {
        // New order CAN be processed
        $order->setState(new ProcessingState());
        return ['success' => true, 'message' => 'Order is now being processed'];
    }

    public function cancel(Order $order): array
    {
        // New order CAN be cancelled
        $order->setState(new CancelledState());
        return ['success' => true, 'message' => 'Order cancelled'];
    }

    public function ship(Order $order): array
    {
        // New order CANNOT be shipped
        return ['success' => false, 'message' => 'Cannot ship unprocessed order'];
    }

    public function deliver(Order $order): array
    {
        // New order CANNOT be delivered
        return ['success' => false, 'message' => 'Cannot deliver unprocessed order'];
    }

    public function getStateName(): string
    {
        return 'New';
    }


}

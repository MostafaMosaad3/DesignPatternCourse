<?php

namespace DesignPattern\State\GoodCode\ConcreteClasses;

use DesignPattern\State\GoodCode\Order;
use DesignPattern\State\GoodCode\OrderState;

/**
 * CONCRETE STATE 3: Shipped Order State
 *
 * ALLOWED ACTIONS: deliver()
 * NOT ALLOWED: process(), cancel(), ship()
 */
class ShippedState implements OrderState
{
    public function process(Order $order): array
    {
        // Shipped order already processed
        return ['success' => false, 'message' => 'Order already shipped'];
    }

    public function cancel(Order $order): array
    {
        // Shipped order CANNOT be cancelled
        return ['success' => false, 'message' => 'Cannot cancel shipped order'];
    }

    public function ship(Order $order): array
    {
        // Shipped order already shipped
        return ['success' => false, 'message' => 'Order already shipped'];
    }

    public function deliver(Order $order): array
    {
        // Shipped order CAN be delivered
        $order->setState(new DeliveredState());
        return ['success' => true, 'message' => 'Order delivered'];
    }

    public function getStateName(): string
    {
        return 'Shipped';
    }
}

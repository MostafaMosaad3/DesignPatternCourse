<?php

namespace DesignPattern\State\GoodCode\ConcreteClasses;

use DesignPattern\State\GoodCode\Order;
use DesignPattern\State\GoodCode\OrderState;

/**
 * CONCRETE STATE 4: Delivered Order State
 *
 * ALLOWED ACTIONS: None (final state)
 * NOT ALLOWED: All actions
 */
class DeliveredState implements OrderState
{

    public function process(Order $order): array
    {
        return ['success' => false, 'message' => 'Order already delivered'];
    }

    public function cancel(Order $order): array
    {
        return ['success' => false, 'message' => 'Cannot cancel delivered order'];
    }

    public function ship(Order $order): array
    {
        return ['success' => false, 'message' => 'Order already delivered'];
    }

    public function deliver(Order $order): array
    {
        return ['success' => false, 'message' => 'Order already delivered'];
    }

    public function getStateName(): string
    {
        return 'Delivered';
    }
}

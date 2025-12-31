<?php

namespace DesignPattern\State\BadCode;

class Order
{
    private string $state ;
    private int $id ;

    public function __construct(int $id)
    {
        $this->id = $id ;
        $this->state = 'new' ;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Process order
     * PROBLEM: if-else to check current state!
     */
    public function process()
    {
        // UGLY IF-ELSE BASED ON STATE!
        if ($this->status === 'new') {
            $this->status = 'processing';
            return ['success' => true, 'message' => 'Order is now being processed'];

        } elseif ($this->status === 'processing') {
            return ['success' => false, 'message' => 'Order is already being processed'];

        } elseif ($this->status === 'shipped') {
            return ['success' => false, 'message' => 'Order already shipped, cannot process'];

        } elseif ($this->status === 'delivered') {
            return ['success' => false, 'message' => 'Order already delivered, cannot process'];

        } else {
            return ['success' => false, 'message' => 'Invalid state'];
        }

        // Want to add "OnHold" state? Must modify this method! ❌
    }


    /**
     * Cancel order
     * PROBLEM: Another if-else to check current state!
     */
    public function cancel(): array
    {
        // MORE IF-ELSE!
        if ($this->status === 'new') {
            $this->status = 'cancelled';
            return ['success' => true, 'message' => 'Order cancelled'];

        } elseif ($this->status === 'processing') {
            $this->status = 'cancelled';
            return ['success' => true, 'message' => 'Order cancelled'];

        } elseif ($this->status === 'shipped') {
            return ['success' => false, 'message' => 'Cannot cancel shipped order'];

        } elseif ($this->status === 'delivered') {
            return ['success' => false, 'message' => 'Cannot cancel delivered order'];

        } else {
            return ['success' => false, 'message' => 'Invalid state'];
        }
    }


    /**
     * Ship order
     * PROBLEM: Yet another if-else!
     */
    public function ship(): array
    {
        // EVEN MORE IF-ELSE!
        if ($this->status === 'new') {
            return ['success' => false, 'message' => 'Cannot ship unprocessed order'];

        } elseif ($this->status === 'processing') {
            $this->status = 'shipped';
            return ['success' => true, 'message' => 'Order shipped'];

        } elseif ($this->status === 'shipped') {
            return ['success' => false, 'message' => 'Order already shipped'];

        } elseif ($this->status === 'delivered') {
            return ['success' => false, 'message' => 'Order already delivered'];

        } else {
            return ['success' => false, 'message' => 'Invalid state'];
        }
    }


    /**
     * Deliver order
     * PROBLEM: More if-else statements!
     */
    public function deliver(): array
    {
        // KEEPS GROWING!
        if ($this->status === 'new') {
            return ['success' => false, 'message' => 'Cannot deliver unprocessed order'];

        } elseif ($this->status === 'processing') {
            return ['success' => false, 'message' => 'Cannot deliver unshipped order'];

        } elseif ($this->status === 'shipped') {
            $this->status = 'delivered';
            return ['success' => true, 'message' => 'Order delivered'];

        } elseif ($this->status === 'delivered') {
            return ['success' => false, 'message' => 'Order already delivered'];

        } else {
            return ['success' => false, 'message' => 'Invalid state'];
        }
    }
}


/**
 * PROBLEMS WITH THIS CODE:
 *
 * ❌ REPETITIVE IF-ELSE STATEMENTS
 *    - Every method checks status with if-else
 *    - Same state checks repeated everywhere
 *    - Hard to read and maintain
 *
 * ❌ VIOLATES OPEN/CLOSED PRINCIPLE
 *    - Want to add "OnHold" state? Must modify ALL methods!
 *    - Want to add "Returned" state? Must modify ALL methods!
 *    - Every new state touches every method
 *
 * ❌ VIOLATES SINGLE RESPONSIBILITY
 *    - Order class knows about ALL state behaviors
 *    - Mixes business logic with state management
 *    - One class doing too much
 *
 * ❌ HARD TO MAINTAIN
 *    - State transitions scattered everywhere
 *    - Hard to see allowed state changes
 *    - Error-prone when adding new states
 *
 * ❌ HARD TO TEST
 *    - Must test all state combinations in one class
 *    - Can't test state behavior independently
 *    - Complex test setup
 *
 * ❌ STATE TRANSITION RULES UNCLEAR
 *    - Rules buried in if-else
 *    - Hard to understand valid transitions
 *    - Can't visualize state machine
 */


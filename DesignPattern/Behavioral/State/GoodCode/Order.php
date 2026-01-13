<?php

namespace DesignPattern\State\GoodCode;

use DesignPattern\State\GoodCode\ConcreteClasses\NewState;

/**
 * CONTEXT: Order class
 *
 * This class USES a state
 * It doesn't know HOW states work!
 * It just delegates to whatever state is current
 */
class Order
{
    private int $id ;
    private orderState $state ;


    public function __construct(int $id)
    {
        $this->id = $id;
        // Start with New state
        $this->orderState = new NewState();
    }

    /**
     * Change the current state
     *
     * Called by states to transition
     */
    public function setState(OrderState $state): void
    {
        $this->state = $state;
    }

    /**
     * Get current state name
     */
    public function getStatus(): string
    {
        return $this->state->getStateName();
    }

    /**
     * Process order
     * Clean! No if-else! Delegates to state!
     */
    public function process(): array
    {
        return $this->state->process($this);
    }

    /**
     * Cancel order
     * Clean! No if-else! Delegates to state!
     */
    public function cancel(): array
    {
        return $this->state->cancel($this);
    }

    /**
     * Ship order
     * Clean! No if-else! Delegates to state!
     */
    public function ship(): array
    {
        return $this->state->ship($this);
    }

    /**
     * Deliver order
     * Clean! No if-else! Delegates to state!
     */
    public function deliver(): array
    {
        return $this->state->deliver($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

}

/**
 * WHAT HAPPENS:
 * 1. Order has an OrderState property
 * 2. All methods delegate to current state
 * 3. State handles the logic
 * 4. State changes itself when needed
 * 5. Order doesn't know or care about state logic!
 */

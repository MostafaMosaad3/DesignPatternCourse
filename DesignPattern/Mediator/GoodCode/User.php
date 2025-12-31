<?php

namespace DesignPattern\Mediator\GoodCode;

// ============================================
// 3. COLLEAGUE: USER
// ============================================

/**
 * ✅ User only knows the mediator, not other users
 */

class User
{
    public string $name ;

    public array $messages  = [];

    private ChatMediator $mediator;

    public function __construct(string $name, ChatMediator $mediator)
    {
        $this->name = $name;
        $this->mediator = $mediator;
        $this->mediator->register($this);
    }


    /**
     * ✅ Send message to specific user via mediator
     */
    public function sendTo(string $message , User $fromUser , User $toUser): void
    {
        $this->mediator->sendMessage($message , $fromUser , $toUser);
    }


    public function sendToAll(string $message , User $fromUser): void
    {
        $this->mediator->sendToAll($message , $fromUser);
    }

    /**
     * ✅ Receive message from mediator
     */
    public function receive(string $message, User $from): void
    {
        $this->messages[] = [
            'from' => $from->name,
            'message' => $message
        ];
    }
}

<?php

namespace DesignPattern\Mediator\GoodCode;

class Group implements ChatMediator
{

    private array $users = [];


    /**
     * ✅ Register user with chat room
     */

    public function register(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * ✅ Send message from one user to another
     */
    public function sendMessage(string $message, User $fromUser, User $toUser): void
    {
        $fromUser->receive($message , $fromUser);
    }

    /**
     * ✅ Broadcast message to all via mediator
     */
    public function sendToAll(string $message, User $fromUser): void
    {
        foreach ($this->users as $user) {
            if ($user !== $fromUser) {
                $user->receive($message, $fromUser);
            }
        }
    }
}


/**
 * ============================================
 * KEY BENEFITS:
 * ============================================
 *
 * ✅ Users don't know about each other
 * ✅ ChatRoom manages all communication
 * ✅ Easy to add new users (one line!)
 * ✅ Easy to extend with new features
 * ✅ Reduced complexity: N connections instead of N×(N-1)
 *
 * WITHOUT MEDIATOR:
 * ❌ 3 users = 6 connections
 * ❌ 10 users = 90 connections
 *
 * WITH MEDIATOR:
 * ✅ 3 users = 3 connections
 * ✅ 10 users = 10 connections
 */

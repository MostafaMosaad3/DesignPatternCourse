<?php

namespace DesignPattern\Mediator\GoodCode;

// ============================================
// 1. MEDIATOR INTERFACE
// ============================================

/**
 * ✅ Mediator interface defines communication methods
 */
interface ChatMediator
{
    public function register(User $user): void ;
    public function sendMessage(string $message , User $fromUser , User $toUser): void ;

    public function sendToAll(string $message , User $fromUser): void ;
}

<?php

namespace DesignPatterns\ChainOfResponsibility\GoodCode;

// ============================================
// HANDLER INTERFACE
// ============================================

interface Handler
{
    public function handle(Request $request): bool ;

    public function setNext(Handler $handler): Handler;
}

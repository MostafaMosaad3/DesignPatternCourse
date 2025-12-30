<?php

namespace DesignPatterns\ChainOfResponsibility\GoodCode\ConcreteClasses;
use DesignPatterns\ChainOfResponsibility\GoodCode\AbstractHandler;
use DesignPatterns\ChainOfResponsibility\GoodCode\Request;

// ============================================
// HANDLER 1: AUTHENTICATION
// ============================================

class AuthenticationHandler extends AbstractHandler
{
    public function handle(Request $request): bool
    {
        // Check authentication
        if (empty($request->token)) {
            return false; // Stop chain
        }

        // Pass to next handler
        return parent::handle($request);
    }
}

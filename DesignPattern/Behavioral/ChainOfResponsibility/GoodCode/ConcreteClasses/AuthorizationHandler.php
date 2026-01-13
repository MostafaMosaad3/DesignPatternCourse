<?php

namespace DesignPatterns\ChainOfResponsibility\GoodCode\ConcreteClasses;

use DesignPatterns\ChainOfResponsibility\GoodCode\AbstractHandler;
use DesignPatterns\ChainOfResponsibility\GoodCode\Request;

// ============================================
// HANDLER 2: AUTHORIZATION
// ============================================

class AuthorizationHandler extends AbstractHandler
{
    public function handle(Request $request): bool
    {
        // Check authorization
        if ($request->role !== 'admin') {
            return false; // Stop chain
        }

        // Pass to next handler
        return parent::handle($request);
    }

}

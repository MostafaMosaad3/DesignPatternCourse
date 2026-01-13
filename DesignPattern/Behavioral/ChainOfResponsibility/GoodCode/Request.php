<?php

namespace DesignPatterns\ChainOfResponsibility\GoodCode;

// ============================================
// GOOD CODE: WITH CHAIN OF RESPONSIBILITY
// ============================================

/**
 * BENEFITS:
 * ✅ Each check is separate handler
 * ✅ Easy to add new handlers
 * ✅ Easy to reorder handlers
 * ✅ Easy to test each handler
 * ✅ Reusable handlers
 */

class Request
{
    public $token ;
    public $role ;

    public $data ;

    public function __construct(?string $token = null, ?string $role = null, ?array $data = [])
    {
        $this->token = $token;
        $this->role = $role;
        $this->data = $data;
    }
}

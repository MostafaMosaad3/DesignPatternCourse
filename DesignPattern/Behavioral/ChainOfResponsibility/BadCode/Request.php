<?php

namespace DesignPatterns\ChainOfResponsibility\BadCode;
// ============================================
// REQUEST CLASS
// ============================================

class Request
{
    public $token ;
    public $role ;
    public $data ;


    public function __construct(?string $token = null , ?string $role = null ,?array $data = null)
    {
        $this->token = $token ;
        $this->role = $role ;
        $this->data = $data ;
    }
}

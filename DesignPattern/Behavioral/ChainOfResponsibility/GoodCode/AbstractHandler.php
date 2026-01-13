<?php

namespace DesignPatterns\ChainOfResponsibility\GoodCode;

// ============================================
// ABSTRACT HANDLER (BASE CLASS)
// ============================================

class AbstractHandler implements Handler
{
    private $nextHandler;

    public function handle(Request $request): bool
    {
        // If can't handle, pass to next
        if($this->nextHandler){
            return $this->nextHandler->handle($request);
        }

        // End of chain
        return true ;
    }

    public function setNext(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }
}

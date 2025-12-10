<?php

namespace App\Observer\GoodCode\Contracts;

/**
* STEP 1: Define Observer Interface
 *
 * This is the contract that all observers must follow
*/
interface UserObserver
{
    /**
     * This method is called when a user is registered
     */
    public function onUserRegistered(User $user): void;
}


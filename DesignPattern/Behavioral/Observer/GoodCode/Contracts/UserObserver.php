<?php

namespace DesignPattern\Observer\GoodCode\Contracts;

use App\Observer\GoodCode\Contracts\User;

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


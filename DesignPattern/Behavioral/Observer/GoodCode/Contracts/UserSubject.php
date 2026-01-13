<?php

namespace DesignPattern\Observer\GoodCode\Contracts;

use App\Observer\GoodCode\Contracts\User;

/**
 * STEP 2: Define Subject Interface
 *
 * This is the contract for objects that can be observed
 */
interface UserSubject
{
    /**
     * Attach an observer to the subject
     */
    public function attach(UserObserver $observer): void;

    /**
     * Detach an observer from the subject
     */
    public function detach(UserObserver $observer): void;

    /**
     * Notify all observers about an event
     */
    public function notify(User $user): void;
}

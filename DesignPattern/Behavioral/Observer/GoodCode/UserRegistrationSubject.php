<?php

namespace DesignPattern\Observer\GoodCode;

use App\Observer\GoodCode\User;
use DesignPattern\Observer\GoodCode\Contracts\UserObserver;
use DesignPattern\Observer\GoodCode\Contracts\UserSubject;

/**
 * STEP 3: Create Concrete Subject
 *
 * This is the object being watched (the publisher)
 */
class UserRegistrationSubject implements UserSubject
{
    /**
     * Array of observers (subscribers)
     */
    private array $observers = [];

    /**
     * Attach an observer
     */
    public function attach(UserObserver $observer): void
    {
        $observerClass = get_class($observer);

        // Prevent duplicate observers
        if (!isset($this->observers[$observerClass])) {
            $this->observers[$observerClass] = $observer;
        }
    }

    /**
     * Detach an observer
     */
    public function detach(UserObserver $observer): void
    {
        $observerClass = get_class($observer);
        unset($this->observers[$observerClass]);
    }

    /**
     * Notify all observers
     */
    public function notify(User $user): void
    {
        foreach ($this->observers as $observer) {
            $observer->onUserRegistered($user);
        }
    }
}

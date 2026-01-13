<?php

namespace DesignPattern\Observer\GoodCode\Observers;

use App\Observer\GoodCode\Contracts\User;
use App\Observer\GoodCode\Observers\Log;
use DesignPattern\Observer\GoodCode\Contracts\UserObserver;

// Observer 2: Log registration
class LogRegistrationObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        Log::info('User registered', [
            'user_id' => $user->id,
            'email' => $user->email,
            'timestamp' => now(),
        ]);
    }
}

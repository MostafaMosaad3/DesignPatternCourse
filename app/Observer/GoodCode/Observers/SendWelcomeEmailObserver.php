<?php

namespace App\Observer\GoodCode\Observers;

use App\Observer\GoodCode\Contracts\User;
use App\Observer\GoodCode\Contracts\UserObserver;

// Observer 1: Send welcome email
class SendWelcomeEmailObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        Mail::raw("Welcome {$user->name}!", function ($message) use ($user) {
            $message->to($user->email)->subject('Welcome!');
        });
    }
}

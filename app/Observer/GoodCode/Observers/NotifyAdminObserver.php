<?php

namespace App\Observer\GoodCode\Observers;

use App\Observer\GoodCode\Contracts\User;
use App\Observer\GoodCode\Contracts\UserObserver;


// Observer 4: Notify admin
class NotifyAdminObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        Mail::raw("New user: {$user->email}", function ($message) {
            $message->to('admin@example.com')->subject('New User');
        });
    }
}

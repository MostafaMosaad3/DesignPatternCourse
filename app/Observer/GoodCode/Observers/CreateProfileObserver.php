<?php

namespace App\Observer\GoodCode\Observers;

use App\Observer\GoodCode\Contracts\User;
use App\Observer\GoodCode\Contracts\UserObserver;

// Observer 3: Create user profile
class CreateProfileObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        Profile::create([
            'user_id' => $user->id,
            'bio' => '',
            'avatar' => 'default.png',
        ]);
    }
}

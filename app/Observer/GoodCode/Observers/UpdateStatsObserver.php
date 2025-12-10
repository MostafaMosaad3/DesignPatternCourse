<?php

namespace App\Observer\GoodCode\Observers;

use App\Observer\GoodCode\Contracts\User;
use App\Observer\GoodCode\Contracts\UserObserver;

// Observer 5: Update statistics
class UpdateStatsObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        DB::table('statistics')->increment('total_users');
    }
}

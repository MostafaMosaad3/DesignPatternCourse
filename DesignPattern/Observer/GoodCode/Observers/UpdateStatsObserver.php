<?php

namespace DesignPattern\Observer\GoodCode\Observers;

use App\Observer\GoodCode\Contracts\User;
use App\Observer\GoodCode\Observers\DB;
use DesignPattern\Observer\GoodCode\Contracts\UserObserver;

// Observer 5: Update statistics
class UpdateStatsObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        DB::table('statistics')->increment('total_users');
    }
}

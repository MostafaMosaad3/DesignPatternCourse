<?php

namespace App\Observer\GoodCode\Observers;

// Observer 7: Send to analytics (easy to add!)
use App\Observer\GoodCode\Contracts\UserObserver;

class SendToAnalyticsObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        // Send to analytics service
        // AnalyticsService::trackRegistration($user);
        echo "Sent to analytics: {$user->email}\n";
    }
}

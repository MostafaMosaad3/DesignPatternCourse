<?php

namespace App\Observer\GoodCode\Observers;

// Observer 6: Send to CRM (easy to add!)
use App\Observer\GoodCode\Contracts\UserObserver;

class SendToCRMObserver implements UserObserver
{
    public function onUserRegistered(User $user): void
    {
        // Send to external CRM system
        // CrmService::createUser($user);
        echo "Sent user to CRM: {$user->email}\n";
    }
}

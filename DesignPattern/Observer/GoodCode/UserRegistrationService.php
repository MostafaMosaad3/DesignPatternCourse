<?php

namespace DesignPattern\Observer\GoodCode;

use App\Observer\GoodCode\User;
use DesignPattern\Observer\GoodCode\Contracts\UserSubject;
use DesignPattern\Observer\GoodCode\Observers\CreateProfileObserver;
use DesignPattern\Observer\GoodCode\Observers\LogRegistrationObserver;
use DesignPattern\Observer\GoodCode\Observers\NotifyAdminObserver;
use DesignPattern\Observer\GoodCode\Observers\SendToAnalyticsObserver;
use DesignPattern\Observer\GoodCode\Observers\SendToCRMObserver;
use DesignPattern\Observer\GoodCode\Observers\SendWelcomeEmailObserver;
use DesignPattern\Observer\GoodCode\Observers\UpdateStatsObserver;

/**
 * STEP 5: Use Observer Pattern in Service
 */
class UserRegistrationService
{
    private UserSubject $subject;

    public function __construct(UserSubject $subject)
    {
        $this->subject = $subject;
    }

    public function registerObservers(): void
    {
        $this->subject->attach(new SendWelcomeEmailObserver());
        $this->subject->attach(new LogRegistrationObserver());
        $this->subject->attach(new CreateProfileObserver());
        $this->subject->attach(new NotifyAdminObserver());
        $this->subject->attach(new UpdateStatsObserver());
        $this->subject->attach(new SendToCrmObserver());
        $this->subject->attach(new SendToAnalyticsObserver());
    }


    /**
     * Create user and notify observers
     * Look how clean this is! 🎉
     */
    public function register(array $data): User
    {
        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Notify all observers (magic happens here!)
        $this->subject->notify($user);

        return $user;
    }

}

<?php

namespace App\Observer\BadCode;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserRegistrationController
{
    public function register(array $data)
    {
        // Create user
        $user = DB::table('users')->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'created_at' => now(),
        ]);

        // Send welcome email - TIGHTLY COUPLED!
        Mail::raw("Welcome {$data['name']}!", function ($message) use ($data) {
            $message->to($data['email'])->subject('Welcome!');
        });

        // Log registration - TIGHTLY COUPLED!
        Log::info('User registered', ['user_id' => $user, 'email' => $data['email']]);

        // Create user profile - TIGHTLY COUPLED!
        DB::table('profiles')->insert([
            'user_id' => $user,
            'bio' => '',
            'avatar' => 'default.png',
            'created_at' => now(),
        ]);

        // Send admin notification - TIGHTLY COUPLED!
        Mail::raw("New user registered: {$data['email']}", function ($message) {
            $message->to('admin@example.com')->subject('New User');
        });

        // Update statistics - TIGHTLY COUPLED!
        DB::table('statistics')->increment('total_users');

        // Send to CRM system - TIGHTLY COUPLED!
        // $this->sendToCRM($user);

        // Send to analytics - TIGHTLY COUPLED!
        // $this->sendToAnalytics($user);

        return $user;
    }
}

/**
 * PROBLEMS WITH THIS APPROACH:
 *
 * ❌ TIGHT COUPLING
 *    - Controller knows about ALL side effects
 *    - Hard to add new actions (must modify controller)
 *    - Violates Single Responsibility Principle
 *
 * ❌ HARD TO TEST
 *    - Must test everything together
 *    - Can't test registration without sending emails
 *
 * ❌ HARD TO MAINTAIN
 *    - Want to add SMS notification? Modify controller!
 *    - Want to remove admin email? Modify controller!
 *    - Every change touches the same file
 *
 * ❌ PERFORMANCE ISSUES
 *    - All actions run synchronously
 *    - Registration is slow (waiting for emails, logs, etc.)
 *
 * ❌ HARD TO REUSE
 *    - Can't reuse welcome email logic elsewhere
 *    - Can't disable specific notifications easily
 */

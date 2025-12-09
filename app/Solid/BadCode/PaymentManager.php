<?php

// ============================================
// BAD CODE - VIOLATES ALL SOLID PRINCIPLES
// ============================================

namespace App\Solid\BadCode;

use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

/**
 * This class violates EVERY SOLID principle:
 * - Does too many things (SRP violation)
 * - Hard to extend without modifying (OCP violation)
 * - Substitution issues (LSP violation)
 * - Forces clients to depend on unused methods (ISP violation)
 * - Depends on concrete implementations (DIP violation)
 */
class PaymentManager
{
    private StripeClient $stripe;
    private string $notificationType = 'email'; // hardcoded dependency

    public function __construct()
    {
        // Directly instantiating dependencies (DIP violation)
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Giant method that does EVERYTHING
     * Violates Single Responsibility Principle
     */
    public function processPayment(array $data)
    {
        // Validation logic mixed in (should be separate)
        if (!isset($data['amount']) || $data['amount'] < 0.01) {
            return ['error' => 'Invalid amount'];
        }
        if (!isset($data['currency']) || strlen($data['currency']) !== 3) {
            return ['error' => 'Invalid currency'];
        }
        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'Invalid email'];
        }

        try {
            // Payment processing logic
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $data['amount'] * 100,
                'currency' => $data['currency'],
                'metadata' => $data['metadata'] ?? [],
            ]);

            // Logging logic mixed in (should be separate)
            Log::info('Payment processed', [
                'id' => $paymentIntent->id,
                'amount' => $data['amount'],
            ]);

            // Database logic mixed in (should be separate)
            DB::table('payments')->insert([
                'transaction_id' => $paymentIntent->id,
                'amount' => $data['amount'],
                'status' => $paymentIntent->status,
                'created_at' => now(),
            ]);

            // Notification logic mixed in (should be separate)
            Mail::raw(
                "Your payment of {$data['amount']} {$data['currency']} was successful!",
                function ($message) use ($data) {
                    $message->to($data['email'])->subject('Payment Confirmation');
                }
            );

            // Business logic for different payment types all mixed together
            if (isset($data['type']) && $data['type'] === 'subscription') {
                // Subscription logic hardcoded here
                DB::table('subscriptions')->insert([
                    'user_email' => $data['email'],
                    'payment_id' => $paymentIntent->id,
                    'billing_cycle' => $data['billing_cycle'] ?? 'monthly',
                    'created_at' => now(),
                ]);
            }

            return [
                'success' => true,
                'id' => $paymentIntent->id,
                'status' => $paymentIntent->status,
            ];

        } catch (\Exception $e) {
            // Error handling mixed in
            Log::error('Payment failed', ['error' => $e->getMessage()]);

            Mail::raw(
                "Your payment failed: {$e->getMessage()}",
                function ($message) use ($data) {
                    $message->to($data['email'])->subject('Payment Failed');
                }
            );

            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Another giant method doing everything for refunds
     * Code duplication everywhere
     */
    public function processRefund(string $transactionId, float $amount, string $email)
    {
        // Validation duplicated
        if ($amount < 0.01) {
            return ['error' => 'Invalid amount'];
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['error' => 'Invalid email'];
        }

        try {
            $refund = $this->stripe->refunds->create([
                'payment_intent' => $transactionId,
                'amount' => $amount * 100,
            ]);

            // Logging duplicated
            Log::info('Refund processed', [
                'id' => $refund->id,
                'amount' => $amount,
            ]);

            // Database logic duplicated
            DB::table('refunds')->insert([
                'refund_id' => $refund->id,
                'transaction_id' => $transactionId,
                'amount' => $amount,
                'status' => $refund->status,
                'created_at' => now(),
            ]);

            // Notification duplicated
            Mail::raw(
                "Your refund of {$amount} was processed successfully!",
                function ($message) use ($email) {
                    $message->to($email)->subject('Refund Confirmation');
                }
            );

            return [
                'success' => true,
                'id' => $refund->id,
                'status' => $refund->status,
            ];

        } catch (\Exception $e) {
            Log::error('Refund failed', ['error' => $e->getMessage()]);

            Mail::raw(
                "Your refund failed: {$e->getMessage()}",
                function ($message) use ($email) {
                    $message->to($email)->subject('Refund Failed');
                }
            );

            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Can't extend this without modifying the class (OCP violation)
     * If you want to add PayPal, you'd have to modify this method
     */
    public function switchGateway(string $gateway)
    {
        if ($gateway === 'stripe') {
            $this->stripe = new StripeClient(config('services.stripe.secret'));
        } elseif ($gateway === 'paypal') {
            // Would need to add PayPal logic here, modifying existing code
            throw new \Exception('PayPal not implemented');
        }
        // To add more gateways, you must modify this method
    }

    /**
     * Tightly coupled to email notifications (DIP violation)
     * Can't easily switch to SMS without modifying code
     */
    public function sendNotification(string $email, string $message)
    {
        if ($this->notificationType === 'email') {
            Mail::raw($message, function ($mail) use ($email) {
                $mail->to($email)->subject('Notification');
            });
        } elseif ($this->notificationType === 'sms') {
            // Would need to hardcode SMS logic here
            throw new \Exception('SMS not implemented');
        }
    }

    /**
     * Forces clients to know about internal implementation details
     * ISP violation - if someone only needs to charge, they still see refund methods
     */
    public function getStripeClient(): StripeClient
    {
        return $this->stripe;
    }

    /**
     * More responsibilities added to the same class
     */
    public function validateCreditCard(string $cardNumber): bool
    {
        // Card validation logic shouldn't be here
        return strlen($cardNumber) === 16 && is_numeric($cardNumber);
    }

    /**
     * Even more responsibilities
     */
    public function calculateFees(float $amount): float
    {
        // Fee calculation logic shouldn't be here
        return $amount * 0.029 + 0.30;
    }

    /**
     * And more...
     */
    public function generateReceipt(array $paymentData): string
    {
        // Receipt generation logic shouldn't be here
        return "Receipt for payment: {$paymentData['id']}";
    }
}

// ============================================
// CONTROLLER USING BAD CODE
// ============================================

namespace App\Http\Controllers;

use App\Stripe\PaymentManager;
use Illuminate\Http\Request;

class BadPaymentController extends Controller
{
    /**
     * Controller is tightly coupled to PaymentManager
     * Can't easily test or swap implementations
     */
    public function charge(Request $request)
    {
        $manager = new PaymentManager(); // Direct instantiation

        $result = $manager->processPayment($request->all());

        if (isset($result['error'])) {
            return response()->json($result, 400);
        }

        return response()->json($result, 200);
    }

    public function refund(Request $request)
    {
        $manager = new PaymentManager(); // Duplicated instantiation

        $result = $manager->processRefund(
            $request->transaction_id,
            $request->amount,
            $request->email
        );

        if (isset($result['error'])) {
            return response()->json($result, 400);
        }

        return response()->json($result, 200);
    }
}

// ============================================
// PROBLEMS WITH THIS CODE:
// ============================================

/**
 * SINGLE RESPONSIBILITY PRINCIPLE (SRP) - VIOLATED
 * PaymentManager does TOO MANY things:
 * - Validates data
 * - Processes payments
 * - Logs transactions
 * - Sends notifications
 * - Manages database
 * - Calculates fees
 * - Generates receipts
 *
 * OPEN/CLOSED PRINCIPLE (OCP) - VIOLATED
 * - Can't add new payment gateways without modifying PaymentManager
 * - Can't add new notification types without modifying sendNotification()
 * - Every new feature requires changing existing code
 *
 * LISKOV SUBSTITUTION PRINCIPLE (LSP) - VIOLATED
 * - No abstraction layer means no substitution possible
 * - Can't swap PaymentManager for another implementation
 *
 * INTERFACE SEGREGATION PRINCIPLE (ISP) - VIOLATED
 * - Single giant class forces clients to depend on methods they don't use
 * - Someone who only needs refunds still sees all payment methods
 *
 * DEPENDENCY INVERSION PRINCIPLE (DIP) - VIOLATED
 * - Depends directly on StripeClient (concrete class)
 * - Depends directly on Mail, Log, DB facades
 * - Controller directly instantiates PaymentManager
 * - Can't easily test with mocks
 * - Can't swap implementations
 */

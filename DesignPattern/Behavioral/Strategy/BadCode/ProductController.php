<?php

namespace DesignPattern\Strategy\BadCode;

/**
 * SCENARIO: E-Commerce Platform
 *
 * REQUIREMENTS:
 * 1. Different pricing for customer segments:
 *    - Regular: Full price (0% discount)
 *    - Gold: 10% discount
 *    - Premium: 20% discount
 *
 * 2. Different payment methods:
 *    - PayPal: 2.9% + $0.30 fee
 *    - Credit Card (Visa): 2.5% + $0.25 fee
 *    - Bank Transfer: No fee, 3-5 days
 */

/**
 * ❌ BAD: Product pricing with if-else hell
 */
class ProductController
{
    private string $productName;
    private float $basePrice ;


    public function __construct(string $productName, int $basePrice)
    {
        $this->productName = $productName;
        $this->basePrice = $basePrice;
    }


     /**
      * Calculate price based on customer type
      * PROBLEM: Long if-else chain that grows with each new customer type!
      */
    public function calculatePrice(string $customerType): float
    {
        // UGLY IF-ELSE CHAIN! 😱
        if ($customerType === 'regular') {
            // Regular customer - full price
            return $this->basePrice;

        } elseif ($customerType === 'gold') {
            // Gold member - 10% discount
            $discount = $this->basePrice * 0.10;
            return $this->basePrice - $discount;

        } elseif ($customerType === 'premium') {
            // Premium member - 20% discount
            $discount = $this->basePrice * 0.20;
            return $this->basePrice - $discount;

        } else {
            // Default to regular price
            return $this->basePrice;
        }

        // Want to add "VIP" customer? Must modify this method! ❌
        // Want to add "Enterprise" customer? Must modify this method again! ❌
        // Violates Open/Closed Principle!
    }


    /**
     * Process payment based on method
     * PROBLEM: Giant switch statement that grows with each new payment method!
     */
    public function processPayment(float $amount, string $paymentMethod): array
    {
        // UGLY SWITCH STATEMENT! 😱
        switch ($paymentMethod) {
            case 'paypal':
                // PayPal processing logic
                $fee = ($amount * 0.029) + 0.30; // 2.9% + $0.30
                $total = $amount + $fee;

                return [
                    'success' => true,
                    'method' => 'PayPal',
                    'amount' => $amount,
                    'fee' => $fee,
                    'total' => $total,
                    'transaction_id' => 'PP_' . uniqid()
                ];

            case 'credit_card':
            case 'visa':
            case 'mastercard':
                // Credit card processing logic
                $fee = ($amount * 0.025) + 0.25; // 2.5% + $0.25
                $total = $amount + $fee;

                return [
                    'success' => true,
                    'method' => 'Credit Card',
                    'amount' => $amount,
                    'fee' => $fee,
                    'total' => $total,
                    'transaction_id' => 'CC_' . uniqid()
                ];

            case 'bank_transfer':
                // Bank transfer logic
                $fee = 0.00; // No fee
                $total = $amount + $fee;

                return [
                    'success' => true,
                    'method' => 'Bank Transfer',
                    'amount' => $amount,
                    'fee' => $fee,
                    'total' => $total,
                    'processing_time' => '3-5 business days'
                ];

            default:
                // Unknown payment method
                return [
                    'success' => false,
                    'error' => 'Unknown payment method: ' . $paymentMethod
                ];
        }

        // Want to add "Apple Pay"? Must modify this method! ❌
        // Want to add "Crypto"? Must modify this method again! ❌
        // Violates Open/Closed Principle!
    }

}


/**
 * PROBLEMS WITH THIS CODE:
 *
 * ❌ LONG IF-ELSE / SWITCH STATEMENTS
 *    - calculatePrice() has nested if-else
 *    - processPayment() has giant switch
 *    - Hard to read and maintain
 *    - Error-prone (easy to break when adding new cases)
 *
 * ❌ VIOLATES OPEN/CLOSED PRINCIPLE
 *    - Want to add new customer type? Modify calculatePrice()!
 *    - Want to add new payment method? Modify processPayment()!
 *    - Every change risks breaking existing code
 *    - Must test all branches every time you add one
 *
 * ❌ VIOLATES SINGLE RESPONSIBILITY
 *    - One method handles all customer types
 *    - One method handles all payment methods
 *    - Methods do too much
 *
 * ❌ HARD TO TEST
 *    - Must test all branches in one method
 *    - Can't test pricing logic separately from payment logic
 *    - Complex test cases
 *    - Mocking is difficult
 *
 * ❌ CODE DUPLICATION
 *    - Similar fee calculation logic repeated
 *    - Similar discount calculation logic repeated
 *    - Similar return structure repeated
 *
 * ❌ TIGHT COUPLING
 *    - Class knows about all customer types
 *    - Class knows about all payment methods
 *    - Hard to reuse logic elsewhere
 *
 * ❌ HARD TO EXTEND
 *    - Want to add "VIP" pricing? Modify calculatePrice()
 *    - Want to add "Apple Pay"? Modify processPayment()
 *    - Want seasonal pricing? Modify calculatePrice() again!
 *    - Each change touches the same file
 */

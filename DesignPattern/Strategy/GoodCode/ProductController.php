<?php

namespace DesignPattern\Strategy\GoodCode;

use DesignPattern\Strategy\GoodCode\Contracts\PaymentStrategy;
use DesignPattern\Strategy\GoodCode\Contracts\PricingStrategy;

class ProductController
{
    private string $name ;
    private float $basePrice;

    private PricingStrategy $pricingStrategy;

    private PaymentStrategy $paymentStrategy;

    public function __construct(string $name, int $basePrice, PricingStrategy $pricingStrategy , PaymentStrategy $paymentStrategy)
    {
        $this->name = $name;
        $this->basePrice = $basePrice;

        // applying (DIP)
        $this->pricingStrategy = $pricingStrategy;
        $this->paymentStrategy = $paymentStrategy;
    }

    /**
     * Set pricing strategy
     *
     * This allows switching strategies at runtime!
     * This is the MAGIC of Strategy Pattern!
     */
    public function setPricingStrategy(PricingStrategy $strategy): void
    {
        $this->pricingStrategy = $strategy;
    }


    public function setPaymentStrategy(PaymentStrategy $strategy): void
    {
        $this->paymentStrategy = $strategy;
    }

    /**
     * Get final price using current strategy
     *
     * Clean! No if-else! Just delegate to strategy!
     */
    public function getFinalPrice(): float
    {
        return $this->pricingStrategy->calculatePrice($this->basePrice);
    }


    public function processCheckout(float $amount): array
    {
        // Calculate fee using strategy
        $fee = $this->paymentStrategy->calculateFee($amount);

        // Process payment using strategy
        $result = $this->paymentStrategy->processPayment($amount);

        return $result;
    }

    /**
     * Get payment info
     */
    public function getPaymentInfo(): string
    {
        return $this->paymentStrategy->getMethodName();
    }

}

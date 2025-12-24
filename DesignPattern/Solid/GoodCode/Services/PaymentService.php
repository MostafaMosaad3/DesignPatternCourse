<?php

namespace DesignPattern\Solid\GoodCode\Services;


use DesignPattern\Solid\GoodCode\Contracts\ChargeableInterface;
use DesignPattern\Solid\GoodCode\Contracts\LoggerInterface;
use DesignPattern\Solid\GoodCode\Contracts\NotifierInterface;
use DesignPattern\Solid\GoodCode\Contracts\RefundableInterface;
use DesignPattern\Solid\GoodCode\Contracts\ValidatorInterface;

/**
 * HIGH-LEVEL MODULE: PaymentService
 * Depends on ABSTRACTIONS (interfaces), not concrete classes
 * This is DIP in action!
 */
class PaymentService
{
    // Depend on interfaces, not concrete classes!
    private ChargeableInterface $charge;
    private RefundableInterface $refund;
    private ValidatorInterface $validator;
    private LoggerInterface $logger;
    private NotifierInterface $notifier;

    /**
     * Dependencies are INJECTED through constructor
     * We don't care WHAT implementation is used
     * Could be Stripe, PayPal, or MockGateway for testing!
     */
    public function __construct(
        ChargeableInterface $charge,
        RefundableInterface $refund,
        ValidatorInterface $validator,
        LoggerInterface $logger,
        NotifierInterface $notifier
    ) {
        $this->charge = $charge;      // Could be StripeGateway or PayPalGateway
        $this->refund = $refund;      // Could be StripeGateway or PayPalGateway
        $this->validator = $validator;  // Could be any validator
        $this->logger = $logger;        // Could be FileLogger or DatabaseLogger
        $this->notifier = $notifier;    // Could be Email, SMS, or Slack
    }

    public function processPayment(array $data): array
    {
        try {
            // Use the abstractions, not concrete classes
            if (!$this->validator->validate($data)) {
                throw new \Exception('Invalid payment data');
            }

            $result = $this->charge->charge(
                $data['amount'],
                $data['currency'],
                $data['metadata'] ?? []
            );

            $this->logger->log('Payment processed', $result);
            $this->notifier->notify($data['email'], 'Payment successful');

            return $result;
        } catch (\Exception $e) {
            $this->logger->log('Payment failed', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
}

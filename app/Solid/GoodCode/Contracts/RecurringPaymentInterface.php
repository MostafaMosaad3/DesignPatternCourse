<?php

namespace App\Solid\GoodCode\Contracts;

/**
 * Small interface: only for recurring payments
 * Classes that don't handle subscriptions don't need to implement this
 */
interface RecurringPaymentInterface
{
    public function createSubscription(array $data): array;
    public function cancelSubscription(string $subscriptionId): bool;
}

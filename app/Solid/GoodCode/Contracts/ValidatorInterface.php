<?php

namespace App\Solid\GoodCode\Contracts;

/**
 * Small interface: only for validation
 */
interface ValidatorInterface
{
    public function validate(array $data): bool;
}

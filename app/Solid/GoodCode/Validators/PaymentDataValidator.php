<?php

namespace App\Solid\GoodCode\Validators;

    /**
     * RESPONSIBILITY: Only validate payment data
     * This class has ONE reason to change: if validation rules change
     */
class PaymentDataValidator
{
    private array $rules = [
        'amount' => 'required|numeric|min:0.01',
        'currency' => 'required|string|size:3',
        'email' => 'required|email',
    ];

    // Only does ONE thing: validate data
    public function validate(array $data): bool
    {
        foreach ($this->rules as $field => $rule) {
            if (!isset($data[$field])) {
                return false;
            }

            if (str_contains($rule, 'numeric') && !is_numeric($data[$field])) {
                return false;
            }

            if (str_contains($rule, 'min:') && $data[$field] < 0.01) {
                return false;
            }
        }

        return true;
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RegisterPasswordRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value)) {
            $fail('The :attribute must be a valid string.');
            return;
        }

        if (strlen($value) < 8) {
            $fail('The :attribute must be at least 8 characters.');
        }

        if (!preg_match('/[A-Z]/', $value)) {
            $fail('The :attribute must include at least one uppercase letter.');
        }

        if (!preg_match('/[a-z]/', $value)) {
            $fail('The :attribute must include at least one lowercase letter.');
        }

        if (!preg_match('/[0-9]/', $value)) {
            $fail('The :attribute must include at least one number.');
        }

        if (!preg_match('/[\W_]/', $value)) {
            $fail('The :attribute must include at least one special character (e.g. @, #, $, %, etc).');
        }
    }
}

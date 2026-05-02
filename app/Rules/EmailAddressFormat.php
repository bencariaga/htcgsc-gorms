<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailAddressFormat implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $allowedDomains = ['@gmail.com', '@online.htcgsc.edu.ph'];

        if (!str($value)->endsWith($allowedDomains)) {
            $fail('Please use a Gmail or an HTCGSC email address.');
        }
    }
}

<?php

namespace App\Rules;

use App\Support\Regex;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberFormat implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!str($value)->isMatch(Regex::philippineMPN())) {
            $fail('The phone number must be a valid Philippine mobile phone number (e.g., 09123456789).');
        }
    }
}

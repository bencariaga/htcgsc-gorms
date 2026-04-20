<?php

namespace App\Rules;

use App\Support\Regex;
use Closure;
use Illuminate\{Contracts\Validation\ValidationRule, Support\Str};

class PhoneNumberFormat implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!Str::isMatch(Regex::philippineMPN(), $value)) {
            $fail('The phone number must be a valid Philippine mobile phone number (e.g., 09123456789).');
        }
    }
}

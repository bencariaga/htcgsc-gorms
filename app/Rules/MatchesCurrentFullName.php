<?php

namespace App\Rules;

use App\Models\Person;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MatchesCurrentFullName implements ValidationRule
{
    protected string $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (str($this->identifier)->isEmpty()) {
            $fail('Please enter your email or phone number first.');

            return;
        }

        $person = Person::where('email_address', $this->identifier)->orWhere('phone_number', $this->identifier)->first();

        if (!$person || $value !== $person->full_name) {
            $fail('The name provided does not match our records for this account.');
        }
    }
}

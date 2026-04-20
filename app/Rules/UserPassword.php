<?php

namespace App\Rules;

use App\Models\{Person, User};
use Closure;
use Illuminate\{Contracts\Validation\ValidationRule, Support\Facades\Hash};

class UserPassword implements ValidationRule
{
    protected ?string $identifier = null;

    public function __construct(?string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $person = Person::where('email_address', $this->identifier)->orWhere('phone_number', $this->identifier)->first();

        if (!$person) {
            return;
        }

        $user = User::where('person_id', $person->person_id)->first();

        if ($user && Hash::check($value, $user->password)) {
            $fail('The new password should not be the same as the current one.');
        }
    }
}

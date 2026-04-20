<?php

namespace App\Rules;

use App\{Enums\AccountStatus, Models\User};
use Closure;
use Illuminate\Contracts\Validation\{DataAwareRule, ValidationRule};
use Illuminate\Support\Facades\Hash;

class UserAuthentication implements DataAwareRule, ValidationRule
{
    protected array $data = [];

    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $password = $this->data['password'] ?? null;

        $method = fn ($q) => $q->whereAny(['email_address', 'phone_number'], $value);

        $user = User::with('person')->whereRelation('person', $method)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            $fail('The provided credentials do not match our records.');

            return;
        }

        if ($user->account_status === AccountStatus::Inactive) {
            $fail('This account is inactive. Please contact the admin to activate it.');
        }
    }
}

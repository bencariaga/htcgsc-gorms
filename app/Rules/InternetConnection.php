<?php

namespace App\Rules;

use App\Exceptions\NoInternetConnectionException;
use Closure;
use Exception;
use Illuminate\{Contracts\Validation\ValidationRule, Support\Facades\Http};

class InternetConnection implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->hasInternalConnection()) {
            throw new NoInternetConnectionException;
        }
    }

    private function hasInternalConnection(): bool
    {
        try {
            return Http::timeout(2)->get('https://8.8.8.8')->successful();
        } catch (Exception) {
            return false;
        }
    }
}

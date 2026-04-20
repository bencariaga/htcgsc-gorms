<?php

namespace App\Rules;

use App\Services\Miscellaneous\OTPService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OneTimePassword implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $status = app(OTPService::class)->validate($value);

        if ($status === 'invalid') {
            $fail('The OTP you entered is incorrect.');
        }

        if ($status === 'expired') {
            $fail("This OTP has expired. Please click 'Resend OTP'.");
        }
    }
}

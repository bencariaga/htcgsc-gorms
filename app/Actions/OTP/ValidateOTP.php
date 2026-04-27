<?php

namespace App\Actions\OTP;

use Illuminate\Support\Facades\Session;

class ValidateOTP
{
    public function handle(string $submittedOtp): string
    {
        if ($submittedOtp !== Session::get('otp_code')) {
            return 'invalid';
        }

        return now()->timestamp > Session::get('otp_expires_at') ? 'expired' : 'valid';
    }
}

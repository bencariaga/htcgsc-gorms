<?php

namespace App\Mail;

class OTPLogin extends BaseMailable
{
    protected function defineMailableConfig(): void
    {
        $this->subjectText = 'Your OTP for this HTCGSC-GORMS Account Login';
        $this->viewName = 'emails.otp-login';
    }
}

<?php

namespace App\Mail;

class OTPEmailAddressChange extends BaseMailable
{
    protected function defineMailableConfig(): void
    {
        $this->subjectText = 'Your OTP for this HTCGSC-GORMS Account Email Address Change';
        $this->viewName = 'emails.otp-email-address-change';
    }
}

<?php

namespace App\Components;

use App\{Enums\NonDB\EmailAndPageOTP, Models\User};
use Illuminate\View\Component;

class OTPEmail extends Component
{
    public string $introText;

    public function __construct(public string $type, public string $otp, public User $user)
    {
        $otpType = EmailAndPageOTP::tryFrom($this->type);
        $this->introText = $otpType ? $otpType->getIntroText() : 'Please use the following one-time password (OTP):';
    }

    public function render()
    {
        return view('layouts.otp-email');
    }
}

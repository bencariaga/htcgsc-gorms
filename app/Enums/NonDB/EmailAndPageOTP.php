<?php

namespace App\Enums\NonDB;

use Illuminate\Support\Facades\Session;

enum EmailAndPageOTP: string
{
    case LOGIN = 'login';
    case EMAIL_CHANGE = 'email_change';
    case PHONE_CHANGE = 'phone_change';

    public function getIntroText(): string
    {
        $base1 = 'To verify your';
        $base2 = 'please use the following one-time password (OTP):';
        $base3 = 'HTCGSC-GORMS';

        return match ($this) {
            self::LOGIN => "{$base1} login to the {$base3}, {$base2}",
            self::EMAIL_CHANGE => "{$base1} email address change to the {$base3} account, {$base2}",
            default => "Please use the following {$base2}",
        };
    }

    public function getPageTitle(): string
    {
        $base4 = 'Verify your';
        $base5 = 'change';

        return match ($this) {
            self::LOGIN => "{$base4} identity.",
            self::EMAIL_CHANGE => "{$base4} email address {$base5}.",
            self::PHONE_CHANGE => "{$base4} phone number {$base5}.",
            default => 'Verify OTP',
        };
    }

    public function getDescription(): string
    {
        $base6 = 'A 6-digit OTP is sent to your new';

        return match ($this) {
            self::LOGIN => "{$base6} via " . (Session::get('otp_method') === 'email' ? 'Gmail' : 'SMS') . ' to',
            self::EMAIL_CHANGE => "{$base6} email address",
            self::PHONE_CHANGE => "{$base6} phone number",
            default => 'Enter the 6-digit code sent to your new',
        };
    }
}

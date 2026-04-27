<?php

namespace App\Services\Miscellaneous;

use App\Actions\Mail\{SendAccountNoticeMail, SendAppointmentReminderMail, SendOtpMail};
use App\Models\{Appointment, Referral, User};

class MailService
{
    public function sendOtpLogin(User $user, string $otp): void
    {
        app(SendOtpMail::class)->handle($user, $otp);
    }

    public function sendEmailChangeOtp(User $user, string $newEmail, string $otp): void
    {
        app(SendOtpMail::class)->handle($user, $otp, $newEmail);
    }

    public function sendAccountNotice(User $user, string $type): void
    {
        app(SendAccountNoticeMail::class)->handle($user, $type);
    }

    public function sendAppointmentReminder(Referral $referral, Appointment $appointment, string $label): void
    {
        app(SendAppointmentReminderMail::class)->handle($referral, $appointment, $label);
    }
}

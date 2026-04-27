<?php

namespace App\Services\Miscellaneous;

use App\Exceptions\NoInternetConnectionException;
use App\Mail\{NoticeReferralAppointment, OTPEmailAddressChange, OTPLogin};
use App\Models\{Appointment, Referral, User};
use Illuminate\{Mail\Mailable, Support\Facades\Mail, Support\Reflector};
use Symfony\Component\Mailer\Exception\TransportException;

class MailService
{
    public function sendOtpLogin(User $user, string $otp): void
    {
        $this->safeSend(new OTPLogin($user, $otp), $user->person->email_address);
    }

    public function sendEmailChangeOtp(User $user, string $newEmail, string $otp): void
    {
        $this->safeSend(new OTPEmailAddressChange($user, $otp), $newEmail);
    }

    public function sendAccountNotice(User $user, string $type): void
    {
        $suffix = str($type)->studly();
        $className = "\App\\Mail\\NoticeAccount{$suffix}";

        if (Reflector::isCallable($className)) {
            $this->safeSend(new $className($user), $user->person->email_address);
        }
    }

    protected function safeSend(Mailable $mailable, string $email): void
    {
        try {
            Mail::to($email)->send($mailable);
        } catch (TransportException) {
            throw new NoInternetConnectionException;
        }
    }

    public function sendAppointmentReminder(Referral $referral, Appointment $appointment, string $label): void
    {
        $this->safeSend(new NoticeReferralAppointment($referral, $appointment, $label), $referral->student->person->email_address);
    }
}

<?php

namespace App\Actions\Mail;

use App\{Exceptions\NoInternetConnectionException, Models\User};
use App\Mail\{OTPEmailAddressChange, OTPLogin};
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;

class SendOtpMail
{
    public function handle(User $user, string $otp, ?string $newEmail = null): void
    {
        $mailable = $newEmail ? new OTPEmailAddressChange($user, $otp) : new OTPLogin($user, $otp);
        $recipient = $newEmail ?? $user->person->email_address;

        try {
            Mail::to($recipient)->send($mailable);
        } catch (TransportException) {
            throw new NoInternetConnectionException;
        }
    }
}

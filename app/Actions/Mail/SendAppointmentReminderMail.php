<?php

namespace App\Actions\Mail;

use App\{Exceptions\NoInternetConnectionException, Mail\NoticeReferralAppointment};
use App\Models\{Appointment, Referral};
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Exception\TransportException;

class SendAppointmentReminderMail
{
    public function handle(Referral $referral, Appointment $appointment, string $label): void
    {
        try {
            Mail::to($referral->student->person->email_address)->send(new NoticeReferralAppointment($referral, $appointment, $label));
        } catch (TransportException) {
            throw new NoInternetConnectionException;
        }
    }
}

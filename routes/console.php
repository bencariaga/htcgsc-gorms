<?php

use App\Actions\Appointment\MarkMissedAppointments;
use App\{Enums\AppointmentStatus, Models\Appointment, Services\Miscellaneous\MailService};
use Illuminate\Support\{Carbon, Facades\Artisan, Facades\Schedule};

Artisan::command('appointments:remind', function (MailService $mailService) {
    $intervals = ['24 Hours' => 1440, '12 Hours' => 720, '6 Hours' => 360, '3 Hours' => 180, '1 Hour' => 60, 'Now' => 0];

    collect($intervals)->each(function ($minutes, $label) use ($mailService) {
        $targetTime = now()->addMinutes($minutes)->startOfMinute();
        $targetFormattedTime = $targetTime->format('H:i');
        $appointments = Appointment::with(['referral.student.person'])->where('appointment_status', AppointmentStatus::Scheduled)->whereDate('appointment_date', $targetTime->toDateString())->get();

        /** @var Appointment $appointment */
        foreach ($appointments as $appointment) {
            $startTime = Carbon::parse(str($appointment->appointment_time->value)->before(' -'))->format('H:i');

            if ($startTime !== $targetFormattedTime) {
                continue;
            }

            $mailService->sendAppointmentReminder($appointment->referral, $appointment, $label);
        }
    });
})->purpose('Send scheduled appointment reminders to referrals.');

Schedule::command('appointments:remind')->everyMinute();

Schedule::call(fn (MarkMissedAppointments $action) => $action->handle())->hourly();

<?php

namespace App\Actions\Appointment;

use App\{Enums\AppointmentStatus, Models\Appointment};
use Illuminate\Support\Carbon;

class MarkMissedAppointments
{
    public function handle(): void
    {
        $now = Carbon::now();

        Appointment::where('appointment_status', AppointmentStatus::Scheduled)->get()->each(function ($appointment) use ($now) {
            $expirationTime = Carbon::parse($appointment->appointment_date)->setTimeFromTimeString($appointment->appointment_time->toTwentyFourHour())->addHour();

            if ($now->greaterThan($expirationTime)) {
                $appointment->update(['appointment_status' => AppointmentStatus::Missed]);
            }
        });
    }
}

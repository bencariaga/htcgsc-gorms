<?php

namespace App\Actions\Appointment;

use App\{Enums\AppointmentStatus, Models\Appointment};
use Illuminate\Support\Carbon;

class MarkMissedAppointments
{
    public function handle(): void
    {
        $now = Carbon::now();
        $today = $now->toDateString();

        Appointment::where('appointment_status', AppointmentStatus::Scheduled)->where('appointment_date', '<', $today)->update(['appointment_status' => AppointmentStatus::Missed]);

        $todayLapsedIds = Appointment::where('appointment_status', AppointmentStatus::Scheduled)->where('appointment_date', $today)->get()->filter(function ($appointment) use ($now) {
            $startTimeString = str($appointment->appointment_time->value)->before(' -')->toString();

            return Carbon::createFromFormat('g:i A', $startTimeString)->setDateFrom($now)->addHour()->lt($now);
        })->pluck('appointment_id');

        if ($todayLapsedIds->isNotEmpty()) {
            Appointment::whereIn('appointment_id', $todayLapsedIds)->update(['appointment_status' => AppointmentStatus::Missed]);
        }
    }
}

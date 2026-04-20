<?php

namespace App\Observers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentObserver
{
    public function creating(Appointment $appointment): void
    {
        $appointment->person_id = $appointment->referral?->student?->person_id;
    }

    public function updated(Appointment $appointment): void
    {
        if ($appointment->wasChanged('appointment_date') || $appointment->wasChanged('appointment_time')) {
            Log::info("Appointment {$appointment->appointment_id} was rescheduled to {$appointment->appointment_date->format('Y-m-d')} at {$appointment->appointment_time->value}.");
        }
    }
}

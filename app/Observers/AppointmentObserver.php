<?php

namespace App\Observers;

use App\{Contracts\HandlesAppointmentEvents, Data\AppointmentData, Models\Appointment};
use Illuminate\Support\Facades\Log;

class AppointmentObserver implements HandlesAppointmentEvents
{
    public function creating(Appointment $appointment): void
    {
        if ($appointment->referral_id) {
            $appointment->person_id = $appointment->referral->student->person_id;
        }
    }

    public function updated(Appointment $appointment): void
    {
        if ($appointment->wasChanged('appointment_date') || $appointment->wasChanged('appointment_time')) {
            Log::info('Appointment rescheduled.', AppointmentData::fromModel($appointment)->toArray());
        }
    }
}

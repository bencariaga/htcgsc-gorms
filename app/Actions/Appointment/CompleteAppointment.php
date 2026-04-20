<?php

namespace App\Actions\Appointment;

use App\{Enums\AppointmentStatus, Models\Appointment};

class CompleteAppointment
{
    public function handle(int $appointmentId): void
    {
        Appointment::where('appointment_id', $appointmentId)->update(['appointment_status' => AppointmentStatus::Done]);
    }
}

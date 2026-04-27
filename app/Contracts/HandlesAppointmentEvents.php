<?php

namespace App\Contracts;

use App\Models\Appointment;

interface HandlesAppointmentEvents
{
    public function creating(Appointment $appointment): void;

    public function updated(Appointment $appointment): void;
}

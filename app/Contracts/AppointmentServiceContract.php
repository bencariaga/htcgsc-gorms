<?php

namespace App\Contracts;

use App\{Data\AppointmentRescheduleData, Models\Appointment};

interface AppointmentServiceContract
{
    public function reschedule(AppointmentRescheduleData $data): Appointment;
}

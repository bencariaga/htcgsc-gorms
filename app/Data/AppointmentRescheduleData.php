<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class AppointmentRescheduleData extends Data
{
    public function __construct(public int|string $appointmentId, public string $date, public string $time) {}
}

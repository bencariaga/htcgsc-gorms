<?php

namespace App\Enums;

use App\Traits\Has\HasValues;
use Illuminate\Support\Carbon;

enum AppointmentTime: string
{
    use HasValues;

    case SLOT_1 = '8:30 AM - 9:30 AM';
    case SLOT_2 = '9:30 AM - 10:30 AM';
    case SLOT_3 = '10:30 AM - 11:30 AM';
    case SLOT_4 = '1:30 PM - 2:30 PM';
    case SLOT_5 = '2:30 PM - 3:30 PM';
    case SLOT_6 = '3:30 PM - 4:30 PM';

    public function toFormattedDisplay(): string
    {
        $times = str($this->value)->explode(' - ')->toArray();

        $start = Carbon::parse($times[0])->format('h:i A');
        $end = Carbon::parse($times[1])->format('h:i A');

        return "{$start} - {$end}";
    }

    public function toTwelveHour(): string
    {
        return $this->toFormattedDisplay();
    }

    public function toTwentyFourHour(): string
    {
        return Carbon::parse(str($this->value)->before(' -'))->format('H:i');
    }

    public function toIsoTime(): string
    {
        return $this->toTwentyFourHour() . ':00';
    }

    public function rescheduleAppointmentModal(): string
    {
        return $this->toFormattedDisplay();
    }
}

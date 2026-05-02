<?php

namespace App\Actions\Appointment;

use App\Enums\AppointmentTime;
use Illuminate\Support\{Carbon, Facades\DB};

class UpdateNewDate
{
    public function handle(?string $value): array
    {
        if (!$value) {
            return [];
        }

        $timeZone = config('app.timezone');
        $isToday = Carbon::parse($value, $timeZone)->isToday();
        $unavailableSlots = DB::table('appointments')->where('appointment_date', $value)->whereIn('appointment_status', ['Scheduled', 'Done'])->pluck('appointment_time')->toArray();
        $availableSlots = collect($unavailableSlots)->merge(collect(AppointmentTime::cases())->filter(fn ($slot) => Carbon::parse("$value {$slot->toTwentyFourHour()}", $timeZone)->isPast())->map(fn ($slot) => $slot->value))->unique()->values()->all();

        return $isToday ? $availableSlots : $unavailableSlots;
    }
}

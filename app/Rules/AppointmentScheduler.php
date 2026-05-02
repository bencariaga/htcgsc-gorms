<?php

namespace App\Rules;

use App\{Enums\AppointmentTime, Enums\NonDB\PhilippineHolidays};
use Closure;
use Illuminate\{Contracts\Validation\ValidationRule, Support\Carbon, Support\Facades\DB};

class AppointmentScheduler implements ValidationRule
{
    public function __construct(protected ?string $time = null) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $date = Carbon::parse($value);

        if ($date->isPast() && !$date->isToday()) {
            $fail('The selected date must be today or a future date.');

            return;
        }

        if ($date->isWeekend()) {
            $fail('Appointments cannot be scheduled on weekends.');

            return;
        }

        if (collect(PhilippineHolidays::all($date->year))->contains($date->toDateString())) {
            $fail('The selected date is a public holiday.');

            return;
        }

        if ($this->time) {
            $this->validateTimeSlot($date, $fail);
        }
    }

    private function validateTimeSlot(Carbon $date, Closure $fail): void
    {
        $selectedTime = AppointmentTime::tryFrom($this->time);

        if (!$selectedTime) {
            $fail('Invalid time slot selected.');

            return;
        }

        if (Carbon::parse("{$date->toDateString()} {$selectedTime->toTwentyFourHour()}")->isPast()) {
            $fail('This time slot has already passed for today.');

            return;
        }

        if ($this->isOccupied($date)) {
            $fail('This time slot is already fully booked.');
        }
    }

    private function isOccupied(Carbon $date): bool
    {
        return DB::table('appointments')->where('appointment_date', $date->toDateString())->where('appointment_time', $this->time)->whereIn('appointment_status', ['Scheduled', 'Done'])->exists();
    }
}

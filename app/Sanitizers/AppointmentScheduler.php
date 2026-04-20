<?php

namespace App\Sanitizers;

use App\{Enums\AppointmentTime, Enums\NonDB\PhilippineHolidays};
use Illuminate\Support\{Carbon, Facades\DB};

class AppointmentScheduler
{
    protected string|int|null $time;

    public function __construct(string|int|null $time)
    {
        $this->time = $time;
    }

    public function handle(mixed $value): array
    {
        $date = Carbon::parse($value);
        $now = Carbon::now();

        if (!$date->isToday()) {
            return $this->resolveAvailableSlot($date);
        }

        $selectedTime = AppointmentTime::tryFrom($this->time);
        $startTime = $selectedTime ? Carbon::createFromFormat('H:i:s', $selectedTime->toIsoTime()) : null;

        if ($startTime && $now->greaterThanOrEqualTo($startTime)) {
            return $this->handleOverdueAppointment($date, $now);
        }

        return $this->resolveAvailableSlot($date);
    }

    private function handleOverdueAppointment(Carbon $date, Carbon $now): array
    {
        $nextSlot = collect(AppointmentTime::cases())->first(fn ($slot) => Carbon::createFromFormat('H:i:s', $slot->toIsoTime())->greaterThan($now));

        if ($nextSlot) {
            $this->time = $nextSlot->value;

            return $this->resolveAvailableSlot($date);
        }

        return $this->resolveAvailableSlot($date->addDay());
    }

    protected function resolveAvailableSlot(Carbon $date): array
    {
        if ($date->isWeekend() || $this->isHoliday($date)) {
            return $this->resolveAvailableSlot($date->addDay());
        }

        $occupiedSlots = DB::table('appointments')->where('appointment_date', $date->toDateString())->whereIn('appointment_status', ['Scheduled', 'Done'])->pluck('appointment_time')->toArray();
        $requestedSlot = AppointmentTime::tryFrom($this->time);
        $availableSlot = collect(AppointmentTime::cases())->skipUntil(fn ($slot) => $slot === $requestedSlot)->first(fn ($slot) => !collect($occupiedSlots)->contains($slot->value));

        if ($availableSlot) {
            $this->time = $availableSlot->value;

            return ['date' => $date->toDateString(), 'time' => $this->time];
        }

        $this->time = AppointmentTime::SLOT_1->value;

        return $this->resolveAvailableSlot($date->addDay());
    }

    protected function isHoliday(Carbon $date): bool
    {
        return collect(PhilippineHolidays::all($date->year))->contains($date->toDateString());
    }
}

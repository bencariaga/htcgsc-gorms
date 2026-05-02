<?php

namespace App\Actions\Appointment;

use App\{Enums\AppointmentStatus, Models\Appointment, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\{Carbon, Facades\Log};

class MarkMissedAppointments
{
    use ManagesTransactions;

    public function handle(): void
    {
        $this->executeTransaction(function () {
            $now = Carbon::now();

            $today = $now->toDateString();

            $pastCount = Appointment::where('appointment_status', AppointmentStatus::Scheduled)->where('appointment_date', '<', $today)->update(['appointment_status' => AppointmentStatus::Missed]);

            $todayLapsedIds = $this->getTodayLapsedIds($now, $today);

            if ($todayLapsedIds->isNotEmpty()) {
                Appointment::whereIn('appointment_id', $todayLapsedIds)->update(['appointment_status' => AppointmentStatus::Missed]);
            }

            $totalMissed = $pastCount + $todayLapsedIds->count();

            if ($totalMissed > 0) {
                Log::info("Successfully marked {$totalMissed} appointments as missed.");
            }
        }, 'Failed to mark missed appointments');
    }

    protected function getTodayLapsedIds(Carbon $now, string $today)
    {
        return Appointment::where('appointment_status', AppointmentStatus::Scheduled)->where('appointment_date', $today)->get()->filter(fn ($appointment) => Carbon::createFromFormat('g:i A', str($appointment->appointment_time->value)->before(' -')->toString())->setDateFrom($now)->addHour()->lt($now))->pluck('appointment_id');
    }
}

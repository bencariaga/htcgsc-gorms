<?php

namespace App\Actions\Appointment;

use App\{Enums\AppointmentStatus, Models\Appointment, Traits\Concerns\ManagesTransactions};
use Illuminate\Support\Facades\Log;

class CompleteAppointment
{
    use ManagesTransactions;

    public function handle(int $appointmentId): void
    {
        $this->executeTransaction(function () use ($appointmentId) {
            Appointment::where('appointment_id', $appointmentId)->update(['appointment_status' => AppointmentStatus::Done]);
            Log::info("Appointment marked as completed for Appointment ID: {$appointmentId}");
        }, 'Failed to complete appointment', ['appointment_id' => $appointmentId]);
    }
}

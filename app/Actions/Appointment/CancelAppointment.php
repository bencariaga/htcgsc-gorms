<?php

namespace App\Actions\Appointment;

use App\{Enums\AppointmentStatus, Models\Appointment, Traits\Miscellaneous\ManagesTransactions};
use Illuminate\Support\Facades\Log;

class CancelAppointment
{
    use ManagesTransactions;

    public function handle(int $appointmentId): void
    {
        $this->executeTransaction(function () use ($appointmentId) {
            Appointment::where('appointment_id', $appointmentId)->update(['appointment_status' => AppointmentStatus::Cancelled]);
            Log::info("Appointment cancelled successfully for Appointment ID: {$appointmentId}");
        }, 'Failed to cancel appointment', ['appointment_id' => $appointmentId]);
    }
}

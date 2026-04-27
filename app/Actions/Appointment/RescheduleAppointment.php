<?php

namespace App\Actions\Appointment;

use App\{Data\AppointmentRescheduleData, Enums\AppointmentStatus, Models\Appointment};
use App\{Http\Requests\UpdateAppointmentTime, Traits\Concerns\ManagesTransactions};
use Illuminate\Support\Facades\{Log, Validator};

class RescheduleAppointment
{
    use ManagesTransactions;

    public function handle(AppointmentRescheduleData $data): Appointment
    {
        $rules = (new UpdateAppointmentTime)->rules();

        Validator::make(['date' => $data->date, 'time' => $data->time], ['date' => $rules['date'], 'time' => $rules['time']])->validate();

        return $this->executeTransaction(function () use ($data) {
            $cleanId = (int) (str($data->appointmentId)->is('*') ? str($data->appointmentId)->replace(' ', '')->toString() : $data->appointmentId);

            $appointment = Appointment::findOrFail($cleanId);

            $appointment->update(['appointment_date' => $data->date, 'appointment_time' => $data->time, 'appointment_status' => AppointmentStatus::Scheduled]);

            Log::info("Appointment rescheduled successfully for Appointment ID: {$cleanId}");

            return $appointment;
        }, 'Failed to reschedule appointment', ['appointment_id' => $data->appointmentId]);
    }
}

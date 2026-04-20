<?php

namespace App\Actions\Appointment;

use App\{Data\AppointmentRescheduleData, Enums\AppointmentStatus, Models\Appointment};
use App\Http\Requests\UpdateAppointmentTime;
use Exception;
use Illuminate\Support\Facades\{DB, Validator};

class RescheduleAppointment
{
    public function handle(AppointmentRescheduleData $data): Appointment
    {
        $rules = (new UpdateAppointmentTime)->rules();

        Validator::make(['date' => $data->date, 'time' => $data->time], ['date' => $rules['date'], 'time' => $rules['time']])->validate();

        return DB::transaction(function () use ($data) {
            try {
                $cleanId = (int) (str($data->appointmentId)->is('*') ? str($data->appointmentId)->replace(' ', '')->toString() : $data->appointmentId);
                $appointment = Appointment::findOrFail($cleanId);

                $appointment->update([
                    'appointment_date' => $data->date,
                    'appointment_time' => $data->time,
                    'appointment_status' => AppointmentStatus::Scheduled,
                ]);

                return $appointment;
            } catch (Exception $e) {
                throw new Exception("Failed to reschedule: {$e->getMessage()}");
            }
        });
    }
}

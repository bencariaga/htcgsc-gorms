<?php

namespace App\Data;

use App\Enums\{AppointmentStatus, PersonType, ReferralType};
use App\Models\Appointment;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

/**
 * @property-read int $appointment_id
 * @property-read PersonData $person
 * @property-read string $formatted_appointment_id
 * @property-read string $reason
 * @property-read string $appointment_date
 * @property-read string $appointment_time
 * @property-read string $appointment_status
 * @property-read string $booked_time_table
 * @property-read string $booked_time_modal
 * @property-read bool $is_reschedulable
 * @property-read string $referrer
 * @property-read bool $is_admin
 */
class AppointmentData extends Data
{
    public function __construct(
        public int $appointment_id,
        public PersonData $person,
        public string $formatted_appointment_id,
        public string $reason,
        public string $appointment_date,
        public string $appointment_time,
        public AppointmentStatus $appointment_status,
        public string $booked_time_table,
        public string $booked_time_modal,
        public bool $is_reschedulable,
        public string $referrer,
        public bool $is_admin,
    ) {}

    public static function fromModel(Appointment $appointment): self
    {
        $person = $appointment->person;
        $status = $appointment->appointment_status;
        $isReschedulable = $status !== AppointmentStatus::Done;
        
        $appointmentDate = $appointment->appointment_date;
        $startTime = Carbon::parse($appointment->appointment_time->toTwentyFourHour())->setDateFrom($appointmentDate);

        $bookedTimeTable = $appointmentDate->format('m-d-y') . ' | ' . $startTime->format('h:i A');
        $bookedTimeModal = $appointmentDate->format('F j, Y') . ', ' . $startTime->format('g:i A');

        $referrerPerson = ($appointment->referral_type === ReferralType::Yourself) ? $person : $appointment->referrerPerson;
        $referrer = $referrerPerson?->formal_name_with_initial ?? 'Unknown';

        return new self(
            appointment_id: $appointment->appointment_id,
            person: PersonData::fromModel($person),
            formatted_appointment_id: $appointment->formatted_appointment_id,
            reason: $appointment->reason,
            appointment_date: $appointment->appointment_date->format('Y-m-d'),
            appointment_time: $appointment->appointment_time->value,
            appointment_status: $status,
            booked_time_table: $bookedTimeTable,
            booked_time_modal: $bookedTimeModal,
            is_reschedulable: $isReschedulable,
            referrer: $referrer,
            is_admin: ($person?->type ?? null) === PersonType::Administrator,
        );
    }
}

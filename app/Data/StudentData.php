<?php

namespace App\Data;

use App\Enums\{PersonType, ReferralType};
use App\Models\{Person, Student};
use Spatie\LaravelData\Data;

/**
 * @property-read int $student_id
 * @property-read PersonData $person
 * @property-read string|null $profile_picture
 * @property-read string $formatted_student_id
 * @property-read bool $is_admin
 * @property-read string $referrer
 * @property-read object|null $latest_appointment
 */
class StudentData extends Data
{
    public function __construct(
        public int $student_id,
        public PersonData $person,
        public ?string $profile_picture,
        public string $formatted_student_id,
        public bool $is_admin,
        public string $referrer,
        public ?object $latest_appointment,
    ) {}

    public static function fromModel(Student $student): self
    {
        $person = $student->person;
        $latestAppointment = $student->referrals->first()?->appointment;

        return new self(
            student_id: $student->student_id,
            person: PersonData::fromModel($person),
            profile_picture: null,
            formatted_student_id: $student->formatted_student_id,
            is_admin: $person?->type === PersonType::Administrator,
            referrer: self::resolveReferrer($latestAppointment, $person),
            latest_appointment: $latestAppointment,
        );
    }

    private static function resolveReferrer(?object $latestAppointment, ?Person $person): string
    {
        if (!$latestAppointment) {
            return '<b>Never referred before</b>';
        }

        $referrerPerson = ($latestAppointment->referral_type === ReferralType::Yourself) ? $person : $latestAppointment->referrer?->student?->person;

        return $referrerPerson?->formal_name_with_initial ?? 'Unknown';
    }
}

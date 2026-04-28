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
    public function __construct(public int $student_id, public PersonData $person, public ?string $profile_picture, public string $formatted_student_id, public bool $is_admin, public string $referrer, public ?object $latest_appointment) {}

    public static function fromModel(Student $student): self
    {
        /** @var mixed $person */
        $person = $student->relationLoaded('person') ? $student->person : null;

        /** @var mixed $latestAppointment */
        $latestAppointment = $student->relationLoaded('referrals') ? $student->referrals->first()?->appointment : null;

        return new self(student_id: $student->student_id, person: PersonData::fromModel($person), profile_picture: null, formatted_student_id: $student->formatted_student_id, is_admin: data_get($person, 'type') === PersonType::Administrator, referrer: self::resolveReferrer($latestAppointment, $person), latest_appointment: $latestAppointment);
    }

    public static function fromId(int $student_id): self
    {
        $student = Student::with('person')->find($student_id);

        if (!$student) {
            return new self(student_id: $student_id, person: PersonData::fromModel(null), profile_picture: null, formatted_student_id: 'Unknown', is_admin: false, referrer: 'Unknown', latest_appointment: null);
        }

        return self::fromModel($student);
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

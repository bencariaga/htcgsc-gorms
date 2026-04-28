<?php

namespace App\Data;

use App\Models\Referral;
use Spatie\LaravelData\Data;

/**
 * @property-read int $referral_id
 * @property-read StudentData $student
 * @property-read string $reason
 * @property-read string $referral_type
 */
class ReferralData extends Data
{
    public function __construct(public int $referral_id, public StudentData $student, public string $reason, public string $referral_type) {}

    public static function fromModel(Referral $referral): self
    {
        /** @var mixed $appointment */
        $appointment = $referral->relationLoaded('appointment') ? $referral->appointment : null;

        /** @var mixed $student */
        $student = $referral->relationLoaded('student') ? $referral->student : null;

        return new self(referral_id: $referral->referral_id, student: $student ? StudentData::fromModel($student) : StudentData::fromId($referral->student_id), reason: $appointment?->reason ?? 'No reason provided', referral_type: data_get($appointment, 'referral_type.value', 'Yourself'));
    }
}

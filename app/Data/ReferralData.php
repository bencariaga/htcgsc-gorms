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
    public function __construct(
        public int $referral_id,
        public StudentData $student,
        public string $reason,
        public string $referral_type,
    ) {}

    public static function fromModel(Referral $referral): self
    {
        return new self(
            referral_id: $referral->referral_id,
            student: StudentData::fromModel($referral->student),
            reason: $referral->reason ?? 'No reason provided',
            referral_type: $referral->referral_type->value,
        );
    }
}

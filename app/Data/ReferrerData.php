<?php

namespace App\Data;

use App\Models\{Referrer, Student};
use Spatie\LaravelData\Data;

/**
 * @property-read int $referrer_id
 * @property-read StudentData $student
 */
class ReferrerData extends Data
{
    public function __construct(public int $referrer_id, public StudentData $student) {}

    public static function fromModel(Referrer $referrer): self
    {
        return new self(referrer_id: $referrer->referrer_id, student: StudentData::fromModel(Student::find($referrer->student_id)));
    }
}

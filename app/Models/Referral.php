<?php

namespace App\Models;

use App\{Enums\ReferralType, Traits\Has\HasCommonModelPattern};
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Relations\HasOne};
use Znck\Eloquent\Relations\BelongsToThrough;

/**
 * @property int $referral_id
 * @property int $student_id
 * @property string $reason
 * @property ReferralType $referral_type
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Student $student
 */
class Referral extends Model
{
    use HasCommonModelPattern;

    /** @var string */
    protected $primaryKey = 'referral_id';

    /** @var array */
    protected $fillable = ['student_id', 'referral_type', 'reason'];

    protected function casts(): array
    {
        return ['referral_type' => ReferralType::class];
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(Referrer::class, 'referrer_id', 'referrer_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class, 'referral_id', 'referral_id');
    }

    public function person(): BelongsToThrough
    {
        return $this->belongsToThrough(Person::class, Student::class, null, '', [Person::class => 'person_id', Student::class => 'student_id']);
    }
}

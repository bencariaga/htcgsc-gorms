<?php

namespace App\Models;

use App\Enums\{PersonSuffix, PersonType};
use App\Traits\Has\{HasCommonModelPattern, HasNameAttributes};
use Illuminate\Database\Eloquent\{Model, Relations\HasOne};
use Staudenmeir\LaravelMergedRelations\Eloquent\Relations\MergedRelation;

/**
 * @property int $person_id
 * @property int $referral_id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property mixed $full_name
 * @property string $email_address
 * @property string $phone_number
 * @property PersonSuffix|null $suffix
 * @property PersonType $type
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Person extends Model
{
    use HasCommonModelPattern, HasNameAttributes;

    /** @var string */
    protected $primaryKey = 'person_id';

    /** @var array */
    protected $fillable = ['type', 'last_name', 'first_name', 'middle_name', 'suffix', 'email_address', 'phone_number'];

    protected function casts(): array
    {
        return ['suffix' => PersonSuffix::class, 'type' => PersonType::class];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'person_id', 'person_id');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'person_id', 'person_id');
    }

    public function appointments()
    {
        return $this->hasManyDeep(Appointment::class, [Student::class, Referral::class], ['person_id', 'student_id', 'referral_id'], ['person_id', 'student_id', 'referral_id']);
    }

    public function allStudentActivities(): MergedRelation
    {
        return $this->mergedRelationWithModel(Student::class, 'all_activities');
    }
}

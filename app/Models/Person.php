<?php

namespace App\Models;

use App\Contracts\{CommonModel, Nameable};
use App\Enums\{PersonSuffix, PersonType};
use App\Traits\Has\HasNameAttributes;
use App\Traits\Miscellaneous\IsCommonModel;
use Illuminate\Database\Eloquent\{Model, Relations\HasOne};
use Staudenmeir\LaravelMergedRelations\Eloquent\Relations\MergedRelation;

/**
 * @property int $person_id
 * @property int $referral_id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property mixed $full_name
 * @property string $formal_name
 * @property string $full_name_with_initial
 * @property string $formal_name_with_initial
 * @property string $email_address
 * @property string $phone_number
 * @property PersonSuffix|null $suffix
 * @property PersonType $type
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Person extends Model implements CommonModel, Nameable
{
    use HasNameAttributes, IsCommonModel;

    /** @var array */
    protected $fillable = ['person_id', 'type', 'last_name', 'first_name', 'middle_name', 'suffix', 'email_address', 'phone_number'];

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

    public function latestActivity(): MergedRelation
    {
        return $this->mergedRelation('all_activities');
    }
}

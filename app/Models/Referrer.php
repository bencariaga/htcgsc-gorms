<?php

namespace App\Models;

use App\{Contracts\CommonModel, Traits\Miscellaneous\IsCommonModel};
use Illuminate\Database\Eloquent\{Model, Relations\BelongsTo, Relations\HasMany};
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Znck\Eloquent\Relations\BelongsToThrough;

/**
 * @property int $referrer_id
 * @property int $student_id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Student $student
 * @property Person $person
 */
class Referrer extends Model implements CommonModel
{
    use IsCommonModel;

    /** @var array */
    protected $fillable = ['referrer_id', 'student_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class, 'referrer_id', 'referrer_id');
    }

    public function person(): BelongsToThrough
    {
        return $this->belongsToThrough(Person::class, Student::class, null, '', [Person::class => 'person_id', Student::class => 'student_id']);
    }

    public function referredStudents(): HasManyDeep
    {
        return $this->hasManyDeep(Student::class, [Appointment::class, Referral::class], ['referrer_id', 'referral_id', 'student_id'], ['referrer_id', 'referral_id', 'student_id']);
    }
}

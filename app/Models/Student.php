<?php

namespace App\Models;

use App\Contracts\CommonModel;
use App\Traits\{Has\HasFormattedId, Miscellaneous\IsCommonModel};
use Illuminate\Database\Eloquent\{Casts\Attribute, Model};
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};
use Staudenmeir\LaravelMergedRelations\Eloquent\Relations\MergedRelation;

/**
 * @property int $student_id
 * @property int $person_id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property-read string $formatted_student_id
 * @property Person $person
 * @property mixed $referrals
 */
class Student extends Model implements CommonModel
{
    use HasFormattedId, IsCommonModel;

    /** @var array */
    protected $fillable = ['student_id', 'person_id'];

    protected function formattedStudentId(): Attribute
    {
        return $this->formattedId();
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'person_id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class, 'student_id', 'student_id');
    }

    public function asReferrer(): HasMany
    {
        return $this->hasMany(Referrer::class, 'student_id', 'student_id');
    }

    public function appointments()
    {
        return $this->hasManyDeep(Appointment::class, [Referral::class], ['student_id', 'referral_id'], ['student_id', 'referral_id']);
    }

    public function latestReferral(): HasOne
    {
        return $this->hasOne(Referral::class, 'student_id', 'student_id')->latestOfMany('referral_id');
    }

    public function latestActivity(): MergedRelation
    {
        return $this->mergedRelation('all_activities');
    }
}

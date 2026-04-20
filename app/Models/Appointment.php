<?php

namespace App\Models;

use App\Enums\{AppointmentStatus, AppointmentTime, ReferralType};
use App\Traits\Has\{HasCommonModelPattern, HasFormattedId};
use Illuminate\Database\Eloquent\{Casts\Attribute, Model, Relations\BelongsTo};
use Znck\Eloquent\Relations\BelongsToThrough;

/**
 * @property int $appointment_id
 * @property int $referrer_id
 * @property int $referral_id
 * @property int $person_id
 * @property ReferralType $referral_type
 * @property string $reason
 * @property mixed $appointment_date
 * @property AppointmentTime $appointment_time
 * @property AppointmentStatus $appointment_status
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property Referral $referral
 */
class Appointment extends Model
{
    use HasCommonModelPattern, HasFormattedId;

    /** @var string */
    protected $primaryKey = 'appointment_id';

    /** @var bool */
    public $incrementing = true;

    /** @var string */
    protected $keyType = 'int';

    /** @var array */
    protected $fillable = ['referrer_id', 'referral_id', 'referral_type', 'reason', 'appointment_date', 'appointment_time', 'appointment_status'];

    protected function casts(): array
    {
        return ['appointment_date' => 'date', 'appointment_time' => AppointmentTime::class, 'appointment_status' => AppointmentStatus::class, 'referral_type' => ReferralType::class];
    }

    protected function formattedAppointmentId(): Attribute
    {
        return $this->formattedId();
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(Referrer::class, 'referrer_id', 'referrer_id');
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class, 'referral_id', 'referral_id');
    }

    public function student(): BelongsToThrough
    {
        return $this->belongsToThrough(Student::class, Referral::class, null, '', [Student::class => 'student_id', Referral::class => 'referral_id']);
    }

    public function person()
    {
        return $this->hasOneDeep(Person::class, [Referral::class, Student::class], ['referral_id', 'student_id', 'person_id'], ['referral_id', 'student_id', 'person_id']);
    }
}

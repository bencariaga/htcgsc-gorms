<?php

namespace App\Models;

use App\Enums\AccountStatus;
use App\Traits\{Has\HasCommonModelPattern, Sets\SetsDefaultStatus};
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\{Foundation\Auth\User as Authenticatable, Notifications\Notifiable};

/**
 * @property int $user_id
 * @property int $person_id
 * @property string $username
 * @property string $password
 * @property string|null $profile_picture
 * @property AccountStatus $account_status
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $person
 */
class User extends Authenticatable
{
    use HasCommonModelPattern, Notifiable, SetsDefaultStatus;

    /** @var string */
    protected $primaryKey = 'user_id';

    /** @var array */
    protected $fillable = ['person_id', 'username', 'account_status', 'password', 'profile_picture'];

    /** @var array */
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['password' => 'hashed', 'account_status' => AccountStatus::class];
    }

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class, 'person_id', 'person_id');
    }

    public function student()
    {
        return $this->belongsToThrough(Student::class, Person::class, null, '', [Student::class => 'person_id', Person::class => 'person_id']);
    }

    public function getRememberTokenName()
    {
        return null;
    }
}

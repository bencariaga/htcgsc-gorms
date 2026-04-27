<?php

namespace App\Data;

use App\Enums\{AccountStatus, PersonType};
use App\Models\User;
use Spatie\LaravelData\Data;

/**
 * @property-read int $user_id
 * @property-read PersonData $person
 * @property-read string|null $profile_picture
 * @property-read string $account_status
 * @property-read bool $is_admin
 * @property-read bool $is_active
 */
class UserData extends Data
{
    public function __construct(
        public int $user_id,
        public PersonData $person,
        public ?string $profile_picture,
        public AccountStatus $account_status,
        public bool $is_admin,
        public bool $is_active,
    ) {}

    public static function fromModel(User $user): self
    {
        return new self(
            user_id: $user->user_id,
            person: PersonData::fromModel($user->person),
            profile_picture: $user->profile_picture,
            account_status: $user->account_status,
            is_admin: $user->person?->type === PersonType::Administrator,
            is_active: $user->account_status === AccountStatus::Active,
        );
    }
}

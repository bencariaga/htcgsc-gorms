<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $user, User $targetUser): bool
    {
        return $user->person->type->isAdministrator() || $user->user_id === $targetUser->user_id;
    }

    public function updatePassword(User $user, User $targetUser): bool
    {
        return $user->user_id === $targetUser->user_id;
    }
}

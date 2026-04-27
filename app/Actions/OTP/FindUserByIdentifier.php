<?php

namespace App\Actions\OTP;

use App\Models\User;

class FindUserByIdentifier
{
    public function handle(string $identifier): ?User
    {
        return User::with('person')->whereRelation('person', fn ($q) => $q->whereAny(['email_address', 'phone_number'], $identifier))->first();
    }
}

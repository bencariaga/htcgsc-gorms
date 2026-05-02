<?php

namespace App\Contracts;

use App\Models\User;

interface HandlesUserEvents
{
    public function creating(User $user): void;
}

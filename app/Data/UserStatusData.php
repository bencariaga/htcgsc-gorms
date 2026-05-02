<?php

namespace App\Data;

use App\Enums\AccountStatus;
use Spatie\LaravelData\Data;

class UserStatusData extends Data
{
    public function __construct(public int $userId, public AccountStatus $status) {}
}

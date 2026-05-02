<?php

namespace App\Contracts;

use App\Data\UserStatusData;

interface UpdatesUserStatus
{
    public function handle(UserStatusData $data): void;
}

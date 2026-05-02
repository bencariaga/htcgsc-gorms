<?php

namespace App\Contracts;

use App\Data\AuthenticateUserData;

interface AuthenticatesUser
{
    public function execute(AuthenticateUserData $data): ?string;
}

<?php

namespace App\Contracts;

use App\Data\UserRegistrationData;

interface RegistersUser
{
    public function execute(UserRegistrationData $data): void;
}

<?php

namespace App\Contracts;

use App\Data\PasswordResetData;

interface ResetsUserPassword
{
    public function execute(PasswordResetData $data): bool;
}

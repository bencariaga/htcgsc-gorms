<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class PasswordResetData extends Data
{
    public function __construct(public string $identifier, public string $newPassword) {}
}

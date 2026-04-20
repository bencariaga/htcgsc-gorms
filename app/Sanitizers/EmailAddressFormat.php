<?php

namespace App\Sanitizers;

use Illuminate\Support\Str;

class EmailAddressFormat
{
    public function handle(mixed $value): string
    {
        $username = Str::before($value, '@');

        return Str::lower($username) . '@online.htcgsc.edu.ph';
    }
}

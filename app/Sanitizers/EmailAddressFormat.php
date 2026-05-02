<?php

namespace App\Sanitizers;


class EmailAddressFormat
{
    public function handle(mixed $value): string
    {
        $username = str($value)->before('@');

        return str($username)->lower() . '@online.htcgsc.edu.ph';
    }
}

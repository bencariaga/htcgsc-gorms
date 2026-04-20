<?php

namespace App\Support;

class AppKeyChecker
{
    public function handle()
    {
        $key = config('app.key');

        if (blank($key) || (str($key)->length() < 10)) {
            return false;
        }

        if (str($key)->startsWith('base64:')) {
            $binaryKey = str($key)->after('base64:')->fromBase64();

            return str($binaryKey)->length() === 32;
        }

        return str($key)->length() === 32;
    }
}

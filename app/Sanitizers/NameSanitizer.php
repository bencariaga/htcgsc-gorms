<?php

namespace App\Sanitizers;


class NameSanitizer
{
    public function handle(mixed $value): string
    {
        return str($value)->trim()->squish()->lower()->title()->toString();
    }
}

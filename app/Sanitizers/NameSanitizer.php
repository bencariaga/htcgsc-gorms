<?php

namespace App\Sanitizers;

use Illuminate\Support\Str;

class NameSanitizer
{
    public function handle(mixed $value): string
    {
        return Str::of($value)->trim()->squish()->lower()->title()->toString();
    }
}

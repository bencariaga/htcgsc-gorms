<?php

namespace App\Sanitizers;

use Illuminate\Support\{Facades\Auth, Str};

class MatchesCurrentFullName
{
    public function handle(mixed $value): string
    {
        if (Auth::check() && Auth::user()->person) {
            return Auth::user()->person->full_name;
        }

        return Str::title(Str::trim($value));
    }
}

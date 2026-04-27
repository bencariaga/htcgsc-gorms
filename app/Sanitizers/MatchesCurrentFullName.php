<?php

namespace App\Sanitizers;

use Illuminate\Support\Facades\Auth;

class MatchesCurrentFullName
{
    public function handle(mixed $value): string
    {
        if (Auth::check() && Auth::user()->person) {
            return Auth::user()->person->full_name;
        }

        return str($value)->trim()->title();
    }
}

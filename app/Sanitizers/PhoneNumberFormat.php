<?php

namespace App\Sanitizers;

use App\Support\Regex;

class PhoneNumberFormat
{
    public function handle(mixed $value): string
    {
        $nonDigits = Regex::nonDigits();
        $toLocal = fn ($str) => $str->replaceFirst('63', '')->start('0');
        $patterns = [['639', 9], ['9', 10]];
        $result = str($value)->replaceMatches($nonDigits, '')->pipe(fn ($str) => collect($patterns)->first(fn ($p) => $str->isMatch(Regex::prefix($p[0], $p[1]))) ? $toLocal($str) : $str)->toString();

        return $result;
    }
}

<?php

namespace App\Support;

class Json
{
    public static function decode(string $json, bool $associative = true, int $depth = 512, int $flags = 0): mixed
    {
        return \json_decode($json, $associative, $depth, $flags);
    }

    public static function encode(mixed $value, int $flags = 0, int $depth = 512): mixed
    {
        return \json_encode($value, $flags, $depth);
    }
}

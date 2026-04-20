<?php

namespace App\Traits\Has;

use Illuminate\Support\Str;

trait HasProfanityList
{
    public function getProfanities(): array
    {
        return collect(config('profanity.english', []))->merge(config('profanity.tagalog', []))->unique()->values()->all();
    }

    public function hasProfanity(string $text): bool
    {
        return Str::contains(Str::lower($text), $this->getProfanities());
    }

    public function maskProfanity(string $text, string $character = '*'): string
    {
        $profanities = $this->getProfanities();

        foreach ($profanities as $word) {
            $text = Str::replaceMatches(
                '/\b' . Str::replace(['/', '\\', '.', '*', '+', '?', '^', '$', '[', ']', '(', ')', '{', '}', '=', '!', '<', '>', '|', ':', '-'], ['\/', '\\\\', '\.', '\*', '\+', '\?', '\^', '\$', '\[', '\]', '\(', '\)', '\{', '\}', '\=', '\!', '\<', '\>', '\|', '\:', '\-'], $word) . '\b/i',
                fn ($matches) => Str::mask($matches[0], $character, 0),
                $text,
            );
        }

        return $text;
    }
}

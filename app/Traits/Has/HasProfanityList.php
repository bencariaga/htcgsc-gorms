<?php

namespace App\Traits\Has;


trait HasProfanityList
{
    public function getProfanities(): array
    {
        return collect(config('profanity.english', []))->merge(config('profanity.tagalog', []))->unique()->values()->all();
    }

    public function hasProfanity(string $text): bool
    {
        return str($text)->lower()->contains($this->getProfanities());
    }

    public function maskProfanity(string $text, string $character = '*'): string
    {
        $profanities = $this->getProfanities();

        foreach ($profanities as $word) {
            $text = str($text)->replaceMatches(
                '/\b' . str($word)->replace(['/', '\\', '.', '*', '+', '?', '^', '$', '[', ']', '(', ')', '{', '}', '=', '!', '<', '>', '|', ':', '-'], ['\/', '\\\\', '\.', '\*', '\+', '\?', '\^', '\$', '\[', '\]', '\(', '\)', '\{', '\}', '\=', '\!', '\<', '\>', '\|', '\:', '\-'])->toString() . '\b/i',
                fn ($matches) => str($matches[0])->mask($character, 0)
            )->toString();
        }

        return $text;
    }
}

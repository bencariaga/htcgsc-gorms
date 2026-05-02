<?php

namespace App\Sanitizers;

use App\Traits\Has\HasProfanityList;
use Illuminate\Support\Facades\Http;

class LanguageSanitizer
{
    use HasProfanityList;

    public function handle(mixed $value): string
    {
        $response = Http::get('https://translate.googleapis.com/translate_a/single', ['client' => 'gtx', 'sl' => 'auto', 'tl' => 'en', 'dt' => 't', 'q' => $value]);
        $translatedText = $response->json()[0][0][0] ?? $value;

        if ($this->hasProfanity($value) || $this->hasProfanity($translatedText)) {
            return '[__]';
        }

        return $value;
    }
}

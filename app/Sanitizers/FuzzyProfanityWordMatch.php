<?php

namespace App\Sanitizers;

use App\{Support\LevenshteinAlgorithm, Support\ScunthorpeProblemSolver, Traits\Has\HasProfanityList};
use Illuminate\Support\Str;

class FuzzyProfanityWordMatch
{
    use HasProfanityList;

    protected LevenshteinAlgorithm $algorithm;

    protected ScunthorpeProblemSolver $solver;

    public function __construct()
    {
        $this->algorithm = new LevenshteinAlgorithm;
        $this->solver = new ScunthorpeProblemSolver;
    }

    public function handle(mixed $value): string
    {
        $profanities = $this->getProfanities();
        $words = Str::of($value)->explode(' ');

        $sanitizedWords = $words->map(function ($word) use ($profanities) {
            if (!$this->solver->isSafe($word, $profanities) || $this->hasSimilarProfanity($word, $profanities)) {
                return Str::repeat('*', Str::length($word));
            }

            return $word;
        });

        return $sanitizedWords->implode(' ');
    }

    private function hasSimilarProfanity(string $word, array $profanities): bool
    {
        return collect($profanities)->contains(fn ($badWord) => $this->algorithm->isSimilar($word, $badWord, 1));
    }
}

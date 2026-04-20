<?php

namespace App\Sanitizers;

use App\Support\LevenshteinAlgorithm;
use Illuminate\Support\{Facades\DB, Str};

class FuzzyNameMatch
{
    protected string $column;

    protected LevenshteinAlgorithm $algorithm;

    public function __construct(string $column)
    {
        $this->column = $column;
        $this->algorithm = new LevenshteinAlgorithm;
    }

    public function handle(mixed $value): string
    {
        $existingNames = DB::table('persons')->pluck($this->column);

        foreach ($existingNames as $existingName) {
            if ($this->algorithm->isSimilar($value, $existingName, 2)) {
                return $existingName;
            }
        }

        return Str::title(Str::trim($value));
    }
}

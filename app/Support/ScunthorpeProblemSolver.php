<?php

namespace App\Support;

class ScunthorpeProblemSolver
{
    public function isSafe(string $text, array $blacklistedWords): bool
    {
        foreach ($blacklistedWords as $word) {
            if (str($text)->is($word)) {
                return false;
            }
        }

        return true;
    }
}

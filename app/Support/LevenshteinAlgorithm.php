<?php

namespace App\Support;

class LevenshteinAlgorithm
{
    public function getDistance(string $str1, string $str2, int $insertion_cost = 1, int $replacement_cost = 1, int $deletion_cost = 1): int
    {
        $string1 = str($str1)->trim()->lower();
        $string2 = str($str2)->trim()->lower();

        $string1Length = $string1->length();
        $string2Length = $string2->length();

        if ($string1Length === 0) {
            return $string2Length * $insertion_cost;
        }

        if ($string2Length === 0) {
            return $string1Length * $deletion_cost;
        }

        $distance = $this->initializeDistanceMatrix($string1Length, $string2Length, $insertion_cost, $deletion_cost);

        for ($i = 1; $i <= $string1Length; $i++) {
            $distance = $this->calculateRowDistance($i, $string2Length, $string1, $string2, $distance, $insertion_cost, $replacement_cost, $deletion_cost);
        }

        return $distance[$string1Length][$string2Length];
    }

    private function initializeDistanceMatrix(int $string1Length, int $string2Length, int $insertion_cost, int $deletion_cost): array
    {
        $distance = [];

        for ($i = 0; $i <= $string1Length; $i++) {
            $distance[$i][0] = $i * $deletion_cost;
        }

        for ($j = 0; $j <= $string2Length; $j++) {
            $distance[0][$j] = $j * $insertion_cost;
        }

        return $distance;
    }

    private function calculateRowDistance(int $i, int $string2Length, string $string1, string $string2, array $distance, int $insertion_cost, int $replacement_cost, int $deletion_cost): array
    {
        for ($j = 1; $j <= $string2Length; $j++) {
            $cost = ($string1[$i - 1] === $string2[$j - 1]) ? 0 : $replacement_cost;

            $distance[$i][$j] = collect([$distance[$i - 1][$j] + $deletion_cost, $distance[$i][$j - 1] + $insertion_cost, $distance[$i - 1][$j - 1] + $cost])->min();
        }

        return $distance;
    }

    public function getSimilarity(string $str1, string $str2): float
    {
        $maxLength = collect([str($str1)->length(), str($str2)->length()])->max();

        if ($maxLength === 0) {
            return 100.0;
        }

        return (1 - $this->getDistance($str1, $str2) / $maxLength) * 100;
    }

    public function isSimilar(string $str1, string $str2, int $threshold = 3): bool
    {
        return $this->getDistance($str1, $str2) <= $threshold;
    }
}

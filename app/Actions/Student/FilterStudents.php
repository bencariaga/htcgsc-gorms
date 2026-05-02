<?php

namespace App\Actions\Student;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\Database\Eloquent\Builder;

class FilterStudents
{
    public function handle(Builder $query, string $filter): Builder
    {
        $options = PaginationStyling::getFilters('student')['options'];

        return match ($filter) {
            $options[1] => $query->has('referrals'),
            $options[2] => $query->whereHas('referrals.appointment', fn ($q) => $q->where('referral_type', 'Yourself')),
            $options[3] => $query->whereDoesntHave('referrals'),
            default => $query,
        };
    }
}

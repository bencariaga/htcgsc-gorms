<?php

namespace App\Actions\User;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\Database\Eloquent\Builder;

class FilterUsers
{
    public function handle(Builder $query, string $filter): Builder
    {
        $options = PaginationStyling::getFilters('user')['options'];

        return match ($filter) {
            $options[1] => $query->where('account_status', 'Active'),
            $options[2] => $query->where('account_status', 'Inactive'),
            default => $query,
        };
    }
}

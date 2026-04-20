<?php

namespace App\Traits\Miscellaneous;

use Illuminate\{Contracts\Pagination\LengthAwarePaginator, Database\Eloquent\Builder};

trait Searchable
{
    public function performSearch(Builder $query, string $idField, string $search, string $sortField, string $sortDirection, int $limit, callable $searchLogic): LengthAwarePaginator
    {
        return $this->searchAndPaginate($query, $limit, $sortField, $sortDirection, $idField, $searchLogic);
    }

    protected function wherePersonMatches(Builder $query, string $search): Builder
    {
        return $query->where(fn ($q) => $q->where('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%")->orWhere('middle_name', 'like', "%{$search}%")->orWhere('email_address', 'like', "%{$search}%")->orWhere('phone_number', 'like', "%{$search}%"));
    }

    protected function searchAndPaginate(Builder $query, int $limit, string $sortField, string $sortDirection, string $idField, callable $searchLogic): LengthAwarePaginator
    {
        $validSortField = ($sortField === 'id') ? $idField : $sortField;
        $query->where($searchLogic);
        $table = $query->getModel()->getTable();

        if ($query->getQuery()->orders) {
            return $query->paginate($limit);
        }

        if (!collect(['last_name', 'first_name', 'name'])->contains($validSortField)) {
            return $query->orderBy("{$table}.{$validSortField}", $sortDirection)->paginate($limit);
        }

        $query->join('persons', function ($join) use ($table) {
            $column = collect(['users', 'students'])->contains($table) ? 'person_id' : 'referrer_id';
            $join->on("{$table}.{$column}", '=', 'persons.person_id');
        });

        $sortColumn = ($validSortField === 'last_name' || $validSortField === 'first_name') ? "persons.{$validSortField}" : 'persons.last_name';

        return $query->orderBy($sortColumn, $sortDirection)->select("{$table}.*")->paginate($limit);
    }
}

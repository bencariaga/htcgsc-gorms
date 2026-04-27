<?php

namespace App\Actions\User;

use App\{Contracts\SearchsUsers, Services\ListType\DataFilteringService};
use App\{Data\UserData, Models\User, Traits\Miscellaneous\Searchable};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchUsers implements SearchsUsers
{
    use Searchable;

    public function __construct(protected DataFilteringService $filterService) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        $query = User::query()->with('person');
        $query = $this->filterService->filter($query, 'user', $filter);

        return $this->performSearch($query, 'user_id', $search, $sortField, $sortDirection, $rowsPerPage, function ($query) use ($search) {
            $query->where('account_status', 'like', "%{$search}%")->orWhereHas('person', function ($q) use ($search) {
                $this->wherePersonMatches($q, $search)->orWhere('type', 'like', "%{$search}%");
            });
        })->through(UserData::fromModel(...));
    }
}

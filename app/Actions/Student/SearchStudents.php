<?php

namespace App\Actions\Student;

use App\{Models\Student, Services\ListType\DataFilteringService, Traits\Miscellaneous\Searchable};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchStudents
{
    use Searchable;

    public function __construct(protected DataFilteringService $filterService) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        $query = Student::query()->with(['person', 'referrals.appointment.referrer.student.person', 'referrals.appointment.referrer.person']);
        $query = $this->filterService->filter($query, 'student', $filter);

        return $this->performSearch($query, 'student_id', $search, $sortField, $sortDirection, $rowsPerPage, fn ($query) => $query->whereHas('person', fn ($q) => $this->wherePersonMatches($q, $search)));
    }
}

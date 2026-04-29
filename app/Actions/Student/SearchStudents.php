<?php

namespace App\Actions\Student;

use App\{Contracts\SearchsStudents, Services\ListType\DataFilteringService};
use App\{Data\StudentData, Models\Student, Traits\Miscellaneous\Searchable};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchStudents implements SearchsStudents
{
    use Searchable;

    public function __construct(protected DataFilteringService $filterService) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        $query = Student::query()->with(['person', 'latestReferral.appointment.referrer.student.person', 'latestReferral.appointment.referrer.person']);
        $query = $this->filterService->filter($query, 'student', $filter);

        return $this->performSearch($query, 'student_id', $search, $sortField, $sortDirection, $rowsPerPage, fn ($query) => $query->whereHas('person', fn ($q) => $this->wherePersonMatches($q, $search)))->through(StudentData::fromModel(...));
    }
}

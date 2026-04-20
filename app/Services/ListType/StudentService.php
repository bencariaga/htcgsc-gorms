<?php

namespace App\Services\ListType;

use App\Actions\Student\{SearchStudents, UpdateStudent};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentService
{
    public function __construct(protected SearchStudents $searchStudents, protected UpdateStudent $updateStudent) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        return $this->searchStudents->handle($search, $filter, $sortField, $sortDirection, $rowsPerPage);
    }

    public function searchStudents(string $search, string $sortField, string $sortDirection, int $limit): LengthAwarePaginator
    {
        return $this->handle($search, 'All', $sortField, $sortDirection, $limit);
    }

    public function update(array $data): void
    {
        $this->updateStudent->handle($data);
    }
}

<?php

namespace App\Services\ListType;

use App\Actions\Student\{CreateStudent, SearchStudents, UpdateStudent};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StudentService
{
    public function __construct(protected SearchStudents $searchStudents, protected UpdateStudent $updateStudent) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        return $this->searchStudents->handle($search, $filter, $sortField, $sortDirection, $rowsPerPage);
    }

    public function create(array $data): int
    {
        return app(CreateStudent::class)->handle($data);
    }

    public function update(int|string $id, array $data): void
    {
        $data['student_id'] = $id;
        $this->updateStudent->handle($data);
    }
}

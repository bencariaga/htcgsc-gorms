<?php

namespace App\Actions\Appointment;

use App\{Models\Appointment, Services\ListType\DataFilteringService, Traits\Miscellaneous\Searchable};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchAppointments
{
    use Searchable;

    public function __construct(protected DataFilteringService $filterService) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        $query = Appointment::query()->with(['referral.student.person', 'person']);
        $query = $this->filterService->filter($query, 'appointment', $filter);

        if ($sortField === 'appointment_date') {
            $query->orderBy('appointment_date', $sortDirection)->orderBy('appointment_time', $sortDirection);
        }

        return $this->performSearch($query, 'appointment_id', $search, $sortField, $sortDirection, $rowsPerPage, function ($query) use ($search) {
            $query->where('reason', 'like', "%$search%")->orWhere('appointment_status', 'like', "%$search%")->orWhere('appointment_date', 'like', "%$search%")->orWhereHas('student.person', fn ($q) => $this->wherePersonMatches($q, $search));
        });
    }
}

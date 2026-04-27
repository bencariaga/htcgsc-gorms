<?php

namespace App\Actions\Appointment;

use App\{Contracts\SearchsAppointments, Services\ListType\DataFilteringService};
use App\{Data\AppointmentData, Models\Appointment, Traits\Miscellaneous\Searchable};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchAppointments implements SearchsAppointments
{
    use Searchable;

    public function __construct(protected DataFilteringService $filterService) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        $query = Appointment::query()->with(['person', 'referrerPerson']);
        $query = $this->filterService->filter($query, 'appointment', $filter);

        if ($sortField === 'appointment_date') {
            $query->orderBy('appointment_date', $sortDirection)->orderBy('appointment_time', $sortDirection);
        }

        return $this->performSearch($query, 'appointment_id', $search, $sortField, $sortDirection, $rowsPerPage, function ($query) use ($search) {
            $query->where('reason', 'like', "%$search%")->orWhere('appointment_status', 'like', "%$search%")->orWhere('appointment_date', 'like', "%$search%")->orWhereHas('person', fn ($q) => $this->wherePersonMatches($q, $search));
        })->through(AppointmentData::fromModel(...));
    }
}

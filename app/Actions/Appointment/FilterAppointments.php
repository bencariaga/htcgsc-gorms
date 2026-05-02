<?php

namespace App\Actions\Appointment;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\Database\Eloquent\Builder;

class FilterAppointments
{
    public function handle(Builder $query, string $filter): Builder
    {
        $options = PaginationStyling::getFilters('appointment')['options'];

        return match ($filter) {
            $options[1] => $query->where('appointment_status', 'Scheduled'),
            $options[2] => $query->where('appointment_status', 'Done'),
            $options[3] => $query->where('appointment_status', 'Cancelled'),
            $options[4] => $query->where('appointment_status', 'Missed'),
            default => $query,
        };
    }
}

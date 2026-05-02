<?php

namespace App\Services\ListType;

use App\Actions\{Appointment\FilterAppointments, AuditLog\FilterAuditLogs, Student\FilterStudents, User\FilterUsers};

class DataFilteringService
{
    protected array $filters;

    public function __construct(FilterUsers $filterUsers, FilterStudents $filterStudents, FilterAppointments $filterAppointments, FilterAuditLogs $filterAuditLogs)
    {
        $this->filters = ['user' => $filterUsers, 'student' => $filterStudents, 'appointment' => $filterAppointments, 'audit-log' => $filterAuditLogs];
    }

    public function filter(mixed $data, string $type, string $filter, string $search = ''): mixed
    {
        $action = $this->filters[$type] ?? null;

        if (!$action) {
            return $data;
        }

        if ($type === 'audit-log') {
            return $action->handle($data, $search, $filter);
        }

        return $action->handle($data, $filter);
    }
}

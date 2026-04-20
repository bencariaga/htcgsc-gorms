<?php

namespace App\Services\ListType;

use App\Actions\Appointment\{CancelAppointment, CompleteAppointment, MarkMissedAppointments, RescheduleAppointment, SearchAppointments};
use App\{Contracts\AppointmentServiceContract, Data\AppointmentRescheduleData, Models\Appointment};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AppointmentService implements AppointmentServiceContract
{
    public function __construct(protected MarkMissedAppointments $markMissed, protected SearchAppointments $searchAppointments, protected CancelAppointment $cancelAppointment, protected CompleteAppointment $completeAppointment, protected RescheduleAppointment $rescheduleAction) {}

    public function handle(string $search, string $filter, string $sortField, string $sortDirection, int $rowsPerPage): LengthAwarePaginator
    {
        $this->markMissed->handle();

        return $this->searchAppointments->handle($search, $filter, $sortField, $sortDirection, $rowsPerPage);
    }

    public function reschedule(AppointmentRescheduleData $data): Appointment
    {
        return $this->rescheduleAction->handle($data);
    }

    public function complete(int $appointmentId): void
    {
        $this->completeAppointment->handle($appointmentId);
    }

    public function cancel(int $appointmentId): void
    {
        $this->cancelAppointment->handle($appointmentId);
    }
}

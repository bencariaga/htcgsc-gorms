<?php

namespace App\Components\Organisms\Tables\Rows;

use App\{Data\PersonData, Enums\AppointmentStatus, Enums\AppointmentTime};
use Illuminate\{Support\Carbon, View\Component};

class Appointment extends Component
{
    public function __construct(public mixed $item, public ?PersonData $person = null, public string $fullName = '—', public bool $isReschedulable = false, public ?array $config = null, public string $referrer = '—', public ?string $bookedTime = null, public ?string $modalBookedTime = null, public string $formalName = '—')
    {
        if ($this->item->person instanceof PersonData) {
            $this->mapPersonData($this->item->person);

            return;
        }

        $this->resolveLegacyProperties();
    }

    private function mapPersonData(PersonData $personData): void
    {
        $this->person = $personData;
        $this->fullName = $personData->full_name;
        $this->config = ['id_key' => 'appointmentId', 'id_val' => $this->item->appointment_id];
        $this->isReschedulable = $this->item->is_reschedulable ?? false;
        $this->bookedTime = $this->item->booked_time_table ?? null;
        $this->modalBookedTime = $this->item->booked_time_modal ?? null;
        $this->referrer = $this->item->referrer ?? '—';
        $this->formalName = $personData->formal_name_with_initial;
    }

    private function resolveLegacyProperties(): void
    {
        $this->person = $this->item->referral?->student?->person;
        $this->fullName = $this->person?->full_name ?? '—';
        $this->config = ['id_key' => 'appointmentId', 'id_val' => $this->item->appointment_id];
        $this->isReschedulable = $this->item->appointment_status !== AppointmentStatus::Done;
        $times = $this->resolveBookedTimes();
        $this->bookedTime = $times['table'] ?? null;
        $this->modalBookedTime = $times['modal'] ?? null;
        $this->referrer = $this->item->person?->formal_name_with_initial ?? 'Unknown';
        $this->formalName = $this->person?->formal_name_with_initial ?? '—';
    }

    private function resolveBookedTimes(): array
    {
        if (!$this->item->appointment_time instanceof AppointmentTime) {
            return [];
        }

        $appointmentDate = Carbon::parse($this->item->appointment_date);
        $timeString = $this->item->appointment_time->toTwentyFourHour();
        $startTime = Carbon::parse($timeString);
        $expirationTime = Carbon::parse($appointmentDate->format('Y-m-d') . ' ' . $timeString);

        if (now()->greaterThan($expirationTime) && $this->item->appointment_status === AppointmentStatus::Scheduled) {
            $this->item->appointment_status = AppointmentStatus::Missed;
        }

        return [
            'table' => $appointmentDate->format('m-d-y') . ' | ' . $startTime->format('h:i A'),
            'modal' => $appointmentDate->format('F j, Y') . ', ' . $startTime->format('g:i A'),
        ];
    }

    public function render()
    {
        return view('components.organisms.tables.rows.appointment');
    }
}

<?php

namespace App\Components\Organisms\Tables;

use App\Data\PersonData;
use App\Enums\{AccountStatus, AppointmentStatus, AppointmentTime, PersonType, ReferralType};
use Illuminate\{Support\Carbon, Support\Reflector, View\Component};
use Illuminate\Support\Stringable;

class TableRow extends Component
{
    public function __construct(
        public mixed $item,
        public string $type,
        public ?object $person = null,
        public string $fullName = '—',
        public ?string $emailAddress = null,
        public ?string $emailAddressLineBreak = null,
        public bool $isAdmin = false,
        public bool $isUser = false,
        public bool $isStudent = false,
        public bool $isAppointment = false,
        public bool $isAuditLog = false,
        public bool $isActive = true,
        public bool $isReschedulable = false,
        public ?array $config = null,
        public ?object $latestAppointment = null,
        public string $referrer = '—',
        public ?string $bookedTime = null,
        public ?string $modalBookedTime = null,
        public ?string $level = null,
        public string $formalNameWithInitial = '—',
        public ?string $phoneNumber = null,
        public ?string $firstName = null,
    ) {
        $this->isUser = $type === 'user';
        $this->isStudent = $type === 'student';
        $this->isAppointment = $type === 'appointment';
        $this->isAuditLog = $type === 'audit-log';

        if (!$this->isAuditLog && !Reflector::isCallable($this->item) && collect($this->item)->has('person') && $this->item->person instanceof PersonData) {
            $this->mapPersonData($this->item->person);
            $this->mapItemSpecifics();

            return;
        }

        $this->resolveLegacyProperties();
    }

    private function mapPersonData(PersonData $personData): void
    {
        $this->person = $personData;
        $this->fullName = $personData->full_name;
        $this->formalNameWithInitial = $personData->formal_name_with_initial;
        $this->phoneNumber = $personData->phone_number;
        $this->firstName = $personData->first_name;
        $this->emailAddress = $personData->email_address;
        $this->emailAddressLineBreak = $personData->email_address_line_break;
        $this->isAdmin = $personData->is_admin;
    }

    private function mapItemSpecifics(): void
    {
        $this->config = $this->resolveConfig();
        $this->isActive = $this->item->is_active ?? true;
        $this->isReschedulable = $this->item->is_reschedulable ?? false;
        $this->bookedTime = $this->item->booked_time_table ?? null;
        $this->modalBookedTime = $this->item->booked_time_modal ?? null;
        $this->referrer = $this->item->referrer ?? '—';
        $this->latestAppointment = $this->item->latest_appointment ?? null;
    }

    private function resolveLegacyProperties(): void
    {
        $this->person = $this->resolvePerson();
        $this->fullName = $this->person?->full_name ?? '—';
        $this->formalNameWithInitial = $this->person?->formal_name_with_initial ?? '—';
        $this->phoneNumber = $this->person?->phone_number ?? '—';
        $this->emailAddress = $this->person?->email_address ?? '—';
        $this->emailAddressLineBreak = str($this->person?->email_address ?? '')->replace('@', '<br>@')->toString();

        $personType = $this->person?->type instanceof \BackedEnum ? $this->person->type->value : $this->person?->type;
        $this->isAdmin = $personType === PersonType::Administrator->value;
        $status = data_get($this->item, 'account_status');
        $this->isActive = $this->isUser && ($status instanceof AccountStatus ? $status === AccountStatus::Active : $status === 'Active');
        $this->config = $this->resolveConfig();

        if ($this->isAppointment) {
            $this->isReschedulable = $this->item->appointment_status !== AppointmentStatus::Done;
            $times = $this->resolveBookedTimes();
            $this->bookedTime = $times['table'] ?? null;
            $this->modalBookedTime = $times['modal'] ?? null;
        }

        $this->latestAppointment = $this->resolveLatestAppointment();
        $this->referrer = $this->resolveReferrer();

        if ($this->isAuditLog) {
            $levelValue = data_get($this->item, 'level');

            $levelName = match (true) {
                $levelValue instanceof \UnitEnum => $levelValue->name,
                Reflector::isCallable($levelValue) && !($levelValue instanceof Stringable) && method_exists($levelValue, 'getName') => $levelValue->getName(),
                default => (string) $levelValue,
            };

            $this->level = str($levelName)->lower()->toString();
        }
    }

    private function resolvePerson()
    {
        if ($this->isAuditLog) {
            return null;
        }

        return match ($this->type) {
            'user', 'student' => $this->item->person,
            'appointment' => $this->item->referral?->student?->person,
            default => null,
        };
    }

    private function resolveLatestAppointment()
    {
        if (!$this->isStudent) {
            return null;
        }

        return $this->item->latestReferral?->appointment;
    }

    private function resolveReferrer(): string
    {
        if ($this->isAppointment) {
            return $this->item->person?->formal_name_with_initial ?? 'Unknown';
        }

        if (!$this->isStudent) {
            return '—';
        }

        if (!$this->latestAppointment) {
            return '<b>Never referred before</b>';
        }

        $person = ($this->latestAppointment->referral_type === ReferralType::Yourself) ? $this->item->person : $this->latestAppointment->referrer?->student?->person;

        return $person?->formal_name_with_initial ?? 'Unknown';
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

    private function resolveConfig(): array
    {
        return match ($this->type) {
            'user' => ['id_key' => 'userId', 'id_val' => $this->item->user_id],
            'student' => ['id_key' => 'studentId', 'id_val' => $this->item->student_id],
            'appointment' => ['id_key' => 'appointmentId', 'id_val' => $this->item->appointment_id],
            'audit-log' => ['id_key' => null, 'id_val' => null],
            default => ['id_key' => 'id', 'id_val' => $this->item->id ?? null],
        };
    }

    public function render()
    {
        return view('components.organisms.tables.table-row');
    }
}

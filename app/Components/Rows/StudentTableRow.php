<?php

namespace App\Components\Rows;

use App\{Data\PersonData, Enums\ReferralType};
use Illuminate\View\Component;

class StudentTableRow extends Component
{
    public function __construct(
        public mixed $item,
        public ?PersonData $person = null,
        public string $fullName = '—',
        public ?string $emailAddress = null,
        public ?string $emailAddressLineBreak = null,
        public ?array $config = null,
        public ?object $latestAppointment = null,
        public string $referrer = '—',
        public string $formalName = '—',
        public string $phoneNumber = '—',
    ) {
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
        $this->emailAddress = $personData->email_address;
        $this->emailAddressLineBreak = $personData->email_address_line_break;
        $this->config = ['id_key' => 'studentId', 'id_val' => $this->item->student_id];
        $this->latestAppointment = $this->item->latest_appointment ?? null;
        $this->referrer = $this->item->referrer ?? '—';
        $this->formalName = $personData->formal_name_with_initial;
        $this->phoneNumber = $personData->phone_number;
    }

    private function resolveLegacyProperties(): void
    {
        $this->person = $this->item->person;
        $this->fullName = $this->person?->full_name ?? '—';
        $this->emailAddress = str($this->person?->email_address ?? '')->replace(['@online.htcgsc.edu.ph', '@gmail.com', '@example.com', '@example.net'], '')->toString();
        $this->emailAddressLineBreak = str($this->person?->email_address ?? '')->replace('@', '<br>@')->toString();
        $this->config = ['id_key' => 'studentId', 'id_val' => $this->item->student_id];

        $this->latestAppointment = $this->item->referrals->first()?->appointment;
        $this->referrer = $this->resolveReferrer();
        $this->formalName = $this->person?->formal_name_with_initial ?? '—';
        $this->phoneNumber = $this->person?->phone_number ?? '—';
    }

    private function resolveReferrer(): string
    {
        if (!$this->latestAppointment) {
            return '<b>Never referred before</b>';
        }

        $person = ($this->latestAppointment->referral_type === ReferralType::Yourself) ? $this->item->person : $this->latestAppointment->referrer?->student?->person;

        return $person?->formal_name_with_initial ?? 'Unknown';
    }

    public function render()
    {
        return view('components.organisms.tables.rows.student');
    }
}

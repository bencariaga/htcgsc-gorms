<?php

namespace App\Components\Organisms\Tables\Rows;

use App\{Data\PersonData, Enums\AccountStatus, Enums\PersonType};
use Illuminate\View\Component;

class User extends Component
{
    public function __construct(public mixed $item, public ?PersonData $person = null, public string $fullName = '—', public ?string $emailAddress = null, public ?string $emailAddressLineBreak = null, public bool $isAdmin = false, public bool $isActive = true, public string $formalName = '—', public string $phoneNumber = '—', public ?array $config = null)
    {
        if (data_get($this->item, 'person') instanceof PersonData) {
            $this->mapPersonData(data_get($this->item, 'person'));

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
        $this->isAdmin = $personData->is_admin;
        $this->isActive = $this->item->is_active ?? true;
        $this->formalName = $personData->formal_name_with_initial;
        $this->phoneNumber = $personData->phone_number;
        $this->config = ['id_key' => 'userId', 'id_val' => $this->item->user_id];
    }

    private function resolveLegacyProperties(): void
    {
        $this->person = $this->item->person;
        $this->fullName = $this->person?->full_name ?? '—';
        $this->emailAddress = $this->person?->email_address ?? '—';
        $this->emailAddressLineBreak = str($this->person?->email_address ?? '')->replace('@', '<br>@')->toString();

        $this->isAdmin = ($this->person?->type === PersonType::Administrator);
        $status = data_get($this->item, 'account_status');
        $this->isActive = ($status instanceof AccountStatus ? $status === AccountStatus::Active : $status === 'Active');
        $this->formalName = $this->person?->formal_name_with_initial ?? '—';
        $this->phoneNumber = $this->person?->phone_number ?? '—';
        $this->config = ['id_key' => 'userId', 'id_val' => $this->item->user_id];
    }

    public function render()
    {
        return view('components.organisms.tables.rows.user');
    }
}

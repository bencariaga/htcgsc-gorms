<?php

namespace App\Data;

use App\{Enums\PersonType, Models\Person};
use Spatie\LaravelData\Data;

/**
 * @property-read string $full_name
 * @property-read string $formal_name_with_initial
 * @property-read string|null $last_name
 * @property-read string|null $first_name
 * @property-read string|null $middle_name
 * @property-read string|null $suffix
 * @property-read string $email_address
 * @property-read string $email_address_line_break
 * @property-read string|null $phone_number
 * @property-read string $type
 * @property-read bool $is_admin
 */
class PersonData extends Data
{
    public function __construct(
        public string $full_name,
        public string $formal_name_with_initial,
        public ?string $last_name,
        public ?string $first_name,
        public ?string $middle_name,
        public ?string $suffix,
        public string $email_address,
        public string $email_address_line_break,
        public ?string $phone_number,
        public PersonType $type,
        public bool $is_admin,
    ) {}

    public static function fromModel(?Person $person): self
    {
        return new self(
            full_name: $person?->full_name ?? '—',
            formal_name_with_initial: $person?->formal_name_with_initial ?? '—',
            last_name: $person?->last_name,
            first_name: $person?->first_name,
            middle_name: $person?->middle_name,
            suffix: $person?->suffix?->value,
            email_address: $person?->email_address ?? '—',
            email_address_line_break: str($person?->email_address ?? '')->replace('@', '<br>@')->toString(),
            phone_number: $person?->phone_number,
            type: $person?->type ?? PersonType::Student,
            is_admin: ($person?->type ?? null) === PersonType::Administrator,
        );
    }
}

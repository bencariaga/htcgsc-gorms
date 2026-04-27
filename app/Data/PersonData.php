<?php

namespace App\Data;

use App\Enums\PersonType;
use App\Models\Person;
use Spatie\LaravelData\Data;

/**
 * @property-read string $full_name
 * @property-read string $formal_name_with_initial
 * @property-read string|null $first_name
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
        public ?string $first_name,
        public string $email_address,
        public string $email_address_line_break,
        public ?string $phone_number,
        public string $type,
        public bool $is_admin,
    ) {}

    public static function fromModel(?Person $person): self
    {
        return new self(
            full_name: $person?->full_name ?? '—',
            formal_name_with_initial: $person?->formal_name_with_initial ?? '—',
            first_name: $person?->first_name,
            email_address: str($person?->email_address ?? '')->replace(['@online.htcgsc.edu.ph', '@gmail.com', '@example.com', '@example.net'], '')->toString(),
            email_address_line_break: str($person?->email_address ?? '')->replace('@', '<br>@')->toString(),
            phone_number: $person?->phone_number,
            type: $person?->type->value ?? '—',
            is_admin: ($person?->type ?? null) === PersonType::Administrator,
        );
    }
}

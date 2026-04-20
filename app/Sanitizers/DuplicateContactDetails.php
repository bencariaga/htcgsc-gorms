<?php

namespace App\Sanitizers;

use App\Models\Person;
use Illuminate\Support\Str;

class DuplicateContactDetails
{
    protected string $column;

    public function __construct(string $column)
    {
        $this->column = $column;
    }

    public function handle(mixed $value): ?string
    {
        if (Str::of($value)->isEmpty()) {
            return null;
        }

        $exists = Person::where($this->column, $value)->exists();

        return $exists ? "[DUPLICATE] {$value}" : $value;
    }
}

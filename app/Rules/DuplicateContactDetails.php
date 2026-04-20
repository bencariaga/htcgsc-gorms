<?php

namespace App\Rules;

use App\Models\Person;
use Closure;
use Illuminate\{Contracts\Validation\ValidationRule, Support\Arr, Support\Str};

class DuplicateContactDetails implements ValidationRule
{
    protected string $column;

    protected mixed $ignoreId;

    protected string $entityType;

    public function __construct(string $column, mixed $ignoreId = null, string $entityType = 'user')
    {
        $this->column = $column;
        $this->ignoreId = $ignoreId;
        $this->entityType = $entityType;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Str::of($value)->isEmpty()) {
            return;
        }

        $errors = [];
        $label = $this->column === 'email_address' ? 'email address' : 'phone number';

        $studentExists = Person::where($this->column, $value)->where('type', 'Student')->when($this->ignoreId, function ($query) {
            $query->where('person_id', '!=', $this->ignoreId);
        })->exists();

        $userExists = Person::where($this->column, $value)->whereIn('type', ['Administrator', 'Employee'])->when($this->ignoreId, function ($query) {
            $query->where('person_id', '!=', $this->ignoreId);
        })->exists();

        if ($this->entityType === 'student' && $studentExists) {
            $errors[] = "The {$label} is already taken by another student.";
        }

        if ($this->entityType === 'user' && $userExists) {
            $errors[] = "The {$label} is already taken by another user.";
        }

        if (filled($errors)) {
            $fail(Arr::join($errors, ' '));
        }
    }
}

<?php

namespace App\Traits\Has;

use App\Enums\PersonSuffix;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|PersonSuffix|null $suffix
 */
trait HasNameAttributes
{
    protected function fullName(): Attribute
    {
        return Attribute::make(get: fn () => $this->formatName('full'));
    }

    protected function formalName(): Attribute
    {
        return Attribute::make(get: fn () => $this->formatName('formal'));
    }

    protected function fullNameWithInitial(): Attribute
    {
        return Attribute::make(get: fn () => $this->formatName('initial'));
    }

    protected function formalNameWithInitial(): Attribute
    {
        return Attribute::make(get: fn () => $this->formatName('formal_initial'));
    }

    private function formatName(string $type): string
    {
        $suffix = $this->suffix instanceof PersonSuffix ? $this->suffix->value : $this->suffix;
        $initial = str($this->middle_name)->substr(0, 1)->toString();
        $initialFormatted = $initial ? "$initial." : null;

        return (match ($type) {
            'full' => collect([$this->first_name, $this->middle_name, $this->last_name, $suffix]),
            'initial' => collect([$this->first_name, $initialFormatted, $this->last_name, $suffix]),
            'formal' => collect([$this->last_name ? "{$this->last_name}," : null, $this->first_name, $this->middle_name, $suffix]),
            'formal_initial' => collect([$this->last_name ? "{$this->last_name}," : null, $this->first_name, $initialFormatted, $suffix]),
        })->filter()->implode(' ');
    }
}

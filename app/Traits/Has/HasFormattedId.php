<?php

namespace App\Traits\Has;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasFormattedId
{
    protected function formattedId(): Attribute
    {
        return Attribute::get($this->getFormattedId(...));
    }

    protected function getFormattedId(): string
    {
        return str($this->{$this->getKeyName()})->padLeft(6, '0')->substrReplace(' ', 3, 0)->toString();
    }
}

<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Casts\Attribute;

interface Nameable
{
    public function name(): Attribute;
}

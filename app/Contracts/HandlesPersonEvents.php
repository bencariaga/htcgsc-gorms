<?php

namespace App\Contracts;

use App\Models\Person;

interface HandlesPersonEvents
{
    public function created(Person $person): void;

    public function updated(Person $person): void;
}

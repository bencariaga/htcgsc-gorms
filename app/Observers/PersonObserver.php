<?php

namespace App\Observers;

use App\{Contracts\HandlesPersonEvents, Data\PersonData, Models\Person};
use Illuminate\Support\Facades\Log;

class PersonObserver implements HandlesPersonEvents
{
    public function created(Person $person): void
    {
        Log::info('Person created.', PersonData::fromModel($person)->toArray());
    }

    public function updated(Person $person): void
    {
        Log::info('Person updated.', PersonData::fromModel($person)->toArray());
    }
}

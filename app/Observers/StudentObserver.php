<?php

namespace App\Observers;

use App\{Contracts\HandlesStudentEvents, Data\StudentData, Models\Student};
use Illuminate\Support\Facades\Log;

class StudentObserver implements HandlesStudentEvents
{
    public function created(Student $student): void
    {
        Log::info('Student created.', StudentData::fromModel($student)->toArray());
    }
}

<?php

namespace App\Observers;

use App\{Contracts\HandlesStudentEvents, Data\StudentData, Models\Student};
use Illuminate\Support\Facades\Log;

class StudentObserver implements HandlesStudentEvents
{
    public function created(Student $student): void
    {
        $student->load(['person', 'referrals.appointment']);

        Log::info('Student created.', StudentData::fromModel($student)->toArray());
    }
}

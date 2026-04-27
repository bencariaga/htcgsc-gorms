<?php

namespace App\Contracts;

use App\Models\Student;

interface HandlesStudentEvents
{
    public function created(Student $student): void;
}

<?php

namespace App\Livewire\Pages;

use App\{Livewire\Bases\BaseListType, Traits\Handles\HandlesStudentActions};
use Livewire\Attributes\Title;

#[Title('Students')]
class Students extends BaseListType
{
    use HandlesStudentActions;

    protected function defaultSortField(): string
    {
        return 'student_id';
    }
}

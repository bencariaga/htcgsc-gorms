<?php

namespace App\Livewire\Pages;

use App\{Livewire\Bases\BaseListType, Traits\Handles\HandlesUserActions};
use Livewire\Attributes\Title;

#[Title('Users')]
class Users extends BaseListType
{
    use HandlesUserActions;

    protected function defaultSortField(): string
    {
        return 'user_id';
    }
}

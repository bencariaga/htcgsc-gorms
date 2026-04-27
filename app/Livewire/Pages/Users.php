<?php

namespace App\Livewire\Pages;

use App\{Livewire\Bases\BaseListType, Traits\Concerns\HandlesUsers};
use Livewire\Attributes\Title;

#[Title('Users')]
class Users extends BaseListType
{
    use HandlesUsers;

    protected function defaultSortField(): string
    {
        return 'user_id';
    }
}

<?php

namespace App\Components;

use App\Enums\AccountStatus;
use Illuminate\View\Component;

class UserGroup extends Component
{
    public bool $isCurrentlyActive;

    public function __construct(public mixed $item, public bool $isAdmin, public string $fullName, public array $config)
    {
        $status = data_get($this->item, 'account_status');
        $this->isCurrentlyActive = $status === AccountStatus::Active || $status === 'Active';
    }

    public function render()
    {
        return view('components.atoms.buttons.action-buttons.user-group');
    }
}

<?php

namespace App\Components;

use App\Enums\NonDB\ListTypeModals;
use Illuminate\View\Component;

class ListType extends Component
{
    public ?ListTypeModals $modalEnum;

    public function __construct(public ?string $type = null)
    {
        $this->modalEnum = ListTypeModals::tryFrom($this->type ?? '');
    }

    public function render()
    {
        return view('components.pages.list-type');
    }
}

<?php

namespace App\Components\Pages;

use App\Enums\NonDB\ListTypeModals;
use Illuminate\View\Component;

class ListType extends Component
{
    public ?ListTypeModals $modalEnum;

    public function __construct(public ?string $type = null, public mixed $filter = null, public mixed $items = null, public mixed $perPage = null, public mixed $sortField = null, public mixed $sortDirection = null, public mixed $columns = null, public string $modalParam = 'id', public array $modalConfig = [], public string $idColumn = 'id', public string $alphaColumn = 'name', public ?string $selectedFileName = null)
    {
        $this->modalEnum = ListTypeModals::tryFrom($this->type ?? '');
    }

    public function render()
    {
        return view('components.pages.list-type');
    }
}

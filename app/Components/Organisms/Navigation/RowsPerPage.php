<?php

namespace App\Components\Organisms\Navigation;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\View\Component;

class RowsPerPage extends Component
{
    public array $options;

    public function __construct(public string|int $perPage, public ?string $type = null)
    {
        $this->options = PaginationStyling::getRowsPerPageOptions();
    }

    public function render()
    {
        return view('components.organisms.navigation.rows-per-page');
    }
}

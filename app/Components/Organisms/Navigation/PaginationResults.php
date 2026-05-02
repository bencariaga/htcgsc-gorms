<?php

namespace App\Components\Organisms\Navigation;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\{Pagination\LengthAwarePaginator, View\Component};

class PaginationResults extends Component
{
    public string $width;

    public int $totalCount;

    public string $resultText = '';

    public string $noResults = '';

    public function __construct(public string $type, public mixed $items)
    {
        $settings = PaginationStyling::getLayoutSettings($this->type);
        $this->width = $settings['results_width'] ?? 'w-[20rem]';
        $isPaginator = $this->items instanceof LengthAwarePaginator;
        $this->totalCount = $isPaginator ? $this->items->total() : collect($this->items)->count();

        if ($this->totalCount <= 0) {
            $this->noResults = 'No ' . str($this->type)->replace('-', ' ')->plural() . ' found.';

            return;
        }

        $first = $isPaginator ? $this->items->firstItem() : 1;
        $last = $isPaginator ? $this->items->lastItem() : $this->totalCount;
        $text = "{$first} to {$last} of {$this->totalCount}";
        $this->resultText = (request()->routeIs('audit-logs.index')) ? $text : "Showing {$text} results";
    }

    public function render()
    {
        return view('components.organisms.navigation.pagination-results');
    }
}

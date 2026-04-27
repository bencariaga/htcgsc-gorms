<?php

namespace App\Components;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

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
        $this->totalCount = $isPaginator ? $this->items->total() : count($this->items);

        if ($this->totalCount > 0) {
            $first = $isPaginator ? $this->items->firstItem() : 1;
            $last = $isPaginator ? $this->items->lastItem() : $this->totalCount;
            $this->resultText = "Showing {$first} to {$last} of {$this->totalCount} results";
        } else {
            $this->noResults = "No " . str($this->type)->replace('-', ' ')->plural() . " found.";
        }
    }

    public function render()
    {
        return view('components.organisms.navigation.pagination-results');
    }
}

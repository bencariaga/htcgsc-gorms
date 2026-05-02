<?php

namespace App\Exports\Report;

use App\Enums\DataCategory;
use App\Exports\Components\{Headings, Styles, Title};
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\{FromQuery, WithEvents, WithHeadings, WithMapping, WithStyles, WithTitle};

class Format implements FromQuery, WithEvents, WithHeadings, WithMapping, WithStyles, WithTitle
{
    use Headings, Styles, Title;

    protected Builder $query;

    protected DataCategory $category;

    protected string $title;

    protected string $startDate;

    protected string $endDate;

    protected string $downloadedAt;

    protected string $downloadedBy;

    protected string $typeClass;

    public function __construct(Builder $query, DataCategory $category, string $title, string $startDate, string $endDate)
    {
        $this->query = $query;
        $this->category = $category;
        $this->title = $title;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->downloadedAt = now()->format('F d, Y | h:i:s A');
        $this->downloadedBy = auth()->user()->person()->first()->formal_name;
        $this->typeClass = 'App\\Exports\\ReportTypes\\' . str($this->category->value)->studly();
    }

    public function query(): Builder
    {
        return $this->query;
    }

    public function map(mixed $item): array
    {
        return ($this->typeClass)::map($item);
    }
}

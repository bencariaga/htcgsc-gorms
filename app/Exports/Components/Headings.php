<?php

namespace App\Exports\Components;

use App\Enums\DataCategory;

/**
 * @property DataCategory $category
 * @property string $typeClass
 */
trait Headings
{
    public function headings(): array
    {
        $properties = ['title', 'startDate', 'endDate', 'downloadedAt', 'downloadedBy'];
        $results = ['category' => "Data Category: {$this->category->value}"];

        foreach ($properties as $property) {
            $results[$property] = str($property)->headline() . ': ' . $this->$property;
        }

        extract($results);

        return [compact('title', 'category', 'startDate', 'endDate', 'downloadedAt', 'downloadedBy'), $this->typeClass::headings()];
    }
}

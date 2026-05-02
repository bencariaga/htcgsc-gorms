<?php

namespace App\Exports\Components;

use App\Enums\DataCategory;

/** @property DataCategory $category */
trait Title
{
    public function title(): string
    {
        return $this->category->value;
    }
}

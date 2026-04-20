<?php

namespace App\Exports\Components;

/**
 * @property array $items
 * @property string $typeClass
 */
trait Arrays
{
    public function array(): array
    {
        return collect($this->items)->map([$this->typeClass, 'map'])->all();
    }
}

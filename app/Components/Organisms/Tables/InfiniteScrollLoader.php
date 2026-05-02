<?php

namespace App\Components\Organisms\Tables;

use Illuminate\View\Component;

class InfiniteScrollLoader extends Component
{
    public function __construct(public mixed $data, public mixed $perPage = 0) {}

    public function render()
    {
        return view('components.organisms.tables.infinite-scroll-loader');
    }
}

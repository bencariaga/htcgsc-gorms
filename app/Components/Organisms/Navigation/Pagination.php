<?php

namespace App\Components\Organisms\Navigation;

use Illuminate\View\Component;

class Pagination extends Component
{
    public function __construct(public mixed $paginator) {}

    public function render()
    {
        return view('components.organisms.navigation.pagination');
    }
}

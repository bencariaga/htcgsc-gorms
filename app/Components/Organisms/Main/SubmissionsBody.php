<?php

namespace App\Components\Organisms\Main;

use Illuminate\View\Component;

class SubmissionsBody extends Component
{
    public function __construct(public mixed $submissions = [], public mixed $renderedSubmissions = '[]', public string $selectedFileName = '', public array $sbms = []) {}

    public function render()
    {
        return view('components.organisms.main.submissions-body');
    }
}

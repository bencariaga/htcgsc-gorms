<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class StudentProfileForm extends Component
{
    public function __construct(public string $id, public mixed $item = null, public bool $modal = false, public ?string $loaderId = null) {}

    public function render()
    {
        return view('components.molecules.forms.student-profile-form');
    }
}

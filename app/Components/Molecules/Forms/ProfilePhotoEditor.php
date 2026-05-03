<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class ProfilePhotoEditor extends Component
{
    public function __construct(public string $title, public string $description) {}

    public function render()
    {
        return view('components.molecules.forms.profile-photo-editor');
    }
}

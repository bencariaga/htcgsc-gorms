<?php

namespace App\Components\Molecules\Forms;

use App\Enums\Enums;
use Illuminate\View\Component;

class UserProfileForm extends Component
{
    public array $suffixes;

    public function __construct(public string $id = 'profileForm', public mixed $user = null, public mixed $person = null)
    {
        $this->suffixes = Enums::suffixes();
    }

    public function render()
    {
        return view('components.molecules.forms.user-profile-form');
    }
}

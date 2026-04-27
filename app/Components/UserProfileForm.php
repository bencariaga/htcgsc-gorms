<?php

namespace App\Components;

use App\Enums\Enums;
use Illuminate\View\Component;

class UserProfileForm extends Component
{
    public array $suffixes;

    public function __construct(public mixed $user, public mixed $person)
    {
        $this->suffixes = Enums::suffixes();
    }

    public function render()
    {
        return view('components.molecules.forms.user-profile-form');
    }
}

<?php

namespace App\Components\Molecules\Forms;

use App\Enums\NonDB\ProfileFormStyling;
use Illuminate\{Support\Collection, View\Component};

class ProfileActionBar extends Component
{
    public Collection $buttons;

    public function __construct(public string $submitText = 'Save Changes', public string $resetText = 'Reset to Default', public string $passwordButtonText = 'Change Password', public bool $showPasswordButton = false)
    {
        $this->buttons = collect(ProfileFormStyling::getActionButtons($this->submitText, $this->resetText, $this->passwordButtonText, $this->showPasswordButton));
    }

    public function render()
    {
        return view('components.molecules.forms.profile-action-bar');
    }
}

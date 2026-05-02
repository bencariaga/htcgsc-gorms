<?php

namespace App\Components\Molecules\Forms;

use App\Enums\Enums;
use Illuminate\View\Component;

class UserProfileForm extends Component
{
    public array $suffixes;

    public function __construct(public string $id = 'profileForm', public mixed $user = null, public mixed $person = null, public bool $modal = false, public bool $isSelf = true, public ?string $loaderId = null, public bool $hasErrors = false, public ?string $profilePicture = null)
    {
        $this->suffixes = Enums::suffixes();

        if ($this->person === null && $this->user !== null) {
            $this->person = $this->user->person ?? null;
        }

        if ($this->profilePicture === null && $this->user !== null) {
            $this->profilePicture = $this->user->profile_picture ?? null;
        }
    }

    public function render()
    {
        return view('components.molecules.forms.user-profile-form');
    }
}

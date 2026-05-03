<?php

namespace App\Components\Molecules\Forms;

use Illuminate\{Support\Collection, View\Component};

class ProfileActionBar extends Component
{
    public Collection $buttons;

    public function __construct(public string $submitText = 'Save Changes', public string $resetText = 'Reset to Default', public string $passwordButtonText = 'Change Password', public bool $showPasswordButton = false)
    {
        $this->buttons = collect([
            $this->showPasswordButton ? [
                'type' => 'button',
                'action' => 'onclick="toggleModal(true)"',
                'width' => 'w-[14rem]',
                'colors' => 'text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700',
                'icon' => 'fas fa-key',
                'text' => $this->passwordButtonText,
                'disabled' => null,
            ] : null,
            [
                'type' => 'button',
                'action' => '@click="resetForm()"',
                'width' => 'w-[12.5rem]',
                'colors' => 'text-orange-600 dark:text-orange-500 hover:bg-orange-100 dark:hover:bg-orange-900/40',
                'icon' => 'fas fa-rotate-left group-hover:rotate-[-45deg]',
                'text' => $this->resetText,
                'disabled' => ':disabled="!anyDirty"',
            ],
            [
                'type' => 'submit',
                'action' => '',
                'width' => 'w-[12rem]',
                'colors' => 'text-emerald-600 dark:text-emerald-500 hover:bg-emerald-100 dark:hover:bg-emerald-900/90',
                'icon' => 'fas fa-floppy-disk opacity-80',
                'text' => $this->submitText,
                'disabled' => ':disabled="!anyDirty"',
            ],
        ])->filter();
    }

    public function render()
    {
        return view('components.molecules.forms.profile-action-bar');
    }
}

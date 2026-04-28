<?php

namespace App\Components\Atoms\Images;

use Illuminate\View\Component;

class UserAvatar extends Component
{
    public string $initials;

    public string $fontSizeClass;

    public function __construct(public mixed $user, public mixed $person, public string $class = 'h-10 w-10')
    {
        $firstName = data_get($this->person, 'first_name', '');
        $lastName = data_get($this->person, 'last_name', '');

        $this->initials = str($firstName)->substr(0, 1)->append(str($lastName)->substr(0, 1))->upper();

        $this->fontSizeClass = match (true) {
            str($this->class)->contains('h-16') => 'text-xl',
            str($this->class)->contains('h-12') => 'text-lg',
            str($this->class)->contains('h-8') => 'text-xs',
            default => 'text-sm',
        };
    }

    public function render()
    {
        return view('components.atoms.images.user-avatar');
    }
}

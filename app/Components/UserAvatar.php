<?php

namespace App\Components;

use Illuminate\View\Component;

class UserAvatar extends Component
{
    public string $initial;
    public string $fontSizeClass;

    public function __construct(public mixed $user, public mixed $person, public string $class = '')
    {
        $this->initial = str($this->person->first_name ?? '')->substr(0, 1)->upper();
        $this->fontSizeClass = str($this->class)->contains('h-10') ? 'text-base' : 'text-xl';
    }

    public function render()
    {
        return view('components.atoms.images.user-avatar');
    }
}

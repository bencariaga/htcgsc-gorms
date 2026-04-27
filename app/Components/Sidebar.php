<?php

namespace App\Components;

use App\Models\User;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public User $user;

    public mixed $person;

    public string $formalName;
    public string $userType;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->person = $this->user->person;
        $this->formalName = $this->person->formal_name_with_initial ?? 'User';
        $this->userType = $this->person->type ?? 'System User';
    }

    public function render()
    {
        return view('components.organisms.layouts.sidebar');
    }
}

<?php

namespace App\Components\Atoms\Feedback;

use Illuminate\View\Component;

class ValidationError extends Component
{
    public function __construct(public string $field, public ?string $alpineTrigger = null) {}

    public function render()
    {
        return view('components.atoms.feedback.validation-error');
    }
}

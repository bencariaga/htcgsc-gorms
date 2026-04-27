<?php

namespace App\Components;

use Illuminate\View\Component;

class InfoSection extends Component
{
    public string $type;
    public string $sectionPaddingTop;

    public function __construct(public string $role, public string $description, public ?string $mode = null, public array $activeSubmission = [], public ?object $gfs = null)
    {
        $this->type = str($this->role)->lower()->title();
        $this->sectionPaddingTop = $this->mode === 'pdf' ? '2.5rem' : '0';
    }

    public function render()
    {
        return view('components.google-forms.info-section');
    }
}

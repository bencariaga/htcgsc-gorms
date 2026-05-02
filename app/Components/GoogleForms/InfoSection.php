<?php

namespace App\Components\GoogleForms;

use Illuminate\View\Component;

class InfoSection extends Component
{
    public string $type;

    public string $sectionPaddingTop;

    public function __construct(public string $role, public string $description, public ?string $mode, public array $activeSubmission, public object $gfs)
    {
        $this->type = str($role)->lower()->title();

        $this->sectionPaddingTop = $mode === 'pdf' ? match ($role) {
            'REFERRER' => '9rem',
            'REFERRAL' => '4rem',
            default => '0',
        } : '0';
    }

    public function render()
    {
        return view('components.google-forms.info-section');
    }
}

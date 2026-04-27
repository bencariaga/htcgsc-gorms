<?php

namespace App\Components;

use App\{Enums\NonDB\GoogleFormsStyling, Services\Miscellaneous\GoogleFormService};
use Illuminate\View\Component;

class GoogleForm extends Component
{
    public object $gfs;
    public string $contactReferrer;

    public function __construct(public array $activeSubmission, public ?string $mode = null, public string $selectedFileName = '', public array $submissions = [], public string $newTab = '')
    {
        $service = app(GoogleFormService::class);
        $urls = $service->getSubmissionUrls();
        $this->gfs = GoogleFormsStyling::variables($urls);
        $this->contactReferrer = $service->getContactReferrerUrl();
    }

    public function getInfoSectionsWithTypes(): array
    {
        return collect($this->gfs->infoSections)->map(fn ($description, $role) => [
            'role' => $role,
            'description' => $description,
            'type' => str($role)->lower()->title(),
        ])->all();
    }

    public function render()
    {
        return view('components.molecules.forms.google-form');
    }
}

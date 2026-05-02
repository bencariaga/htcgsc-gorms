<?php

namespace App\Components\Molecules\Forms;

use App\{Enums\NonDB\GoogleFormsStyling, Services\Miscellaneous\GoogleFormService};
use Illuminate\View\Component;

class GoogleForm extends Component
{
    public object $gfs;

    public string $contactReferrer;

    public array $infoSections;

    public function __construct(public array $activeSubmission = [], public ?string $mode = null, public string $selectedFileName = '', public array $submissions = [], public string $newTab = '')
    {
        $service = app(GoogleFormService::class);
        $urls = $service->getSubmissionUrls();
        $this->gfs = GoogleFormsStyling::variables($urls);
        $this->contactReferrer = $service->getContactReferrerUrl();

        $this->infoSections = collect($this->gfs->infoSections)->map(function ($description, $role) {
            $type = str($role)->lower()->title();

            return compact('role', 'description', 'type');
        })->all();
    }

    public function render()
    {
        return view('components.molecules.forms.google-form');
    }
}

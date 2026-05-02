<?php

namespace App\Actions\GoogleForms\Generators;

use App\Traits\Handles\HandlesBrowsershot;

class GeneratePdfSubmission
{
    use HandlesBrowsershot;

    public function handle(array $submission): string
    {
        $html = $this->renderView($submission, 'pdf');

        return $this->browser($html)->format('Letter')->pdf();
    }
}

<?php

namespace App\Actions\GoogleForms\Generators;

use App\Traits\Handles\HandlesBrowsershot;

class GenerateImageSubmission
{
    use HandlesBrowsershot;

    public function handle(array $submission): string
    {
        $html = $this->renderView($submission, 'png');

        return $this->browser($html)->fullPage()->screenshot();
    }
}

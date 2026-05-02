<?php

namespace App\Components\Molecules\Sidebars;

class SubmissionsSidebar extends TemplateSidebar
{
    public function __construct(public mixed $files = [], public mixed $selectedFile = null, public ?string $onFetch = null, public array $nameStrip = ['google-forms-'])
    {
        parent::__construct(files: $files, selectedFile: $selectedFile, title: 'Submissions', onFetch: $onFetch, nameStrip: $nameStrip);
    }
}

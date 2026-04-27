<?php

namespace App\Components;

class SubmissionsSidebar extends TemplateSidebar
{
    public function __construct(
        public mixed $files = [],
        public mixed $selectedFile = null,
        public ?string $onFetch = null,
    ) {
        parent::__construct(
            files: $files,
            selectedFile: $selectedFile,
            title: 'Submissions',
            onFetch: $onFetch
        );
    }
}

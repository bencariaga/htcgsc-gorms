<?php

namespace App\Components\Molecules\Sidebars;

class ReportsSidebar extends TemplateSidebar
{
    public function __construct(public mixed $files = [], public mixed $selectedFile = null)
    {
        parent::__construct(files: $files, selectedFile: $selectedFile, title: 'Reports', fetchAction: 'selectReport', deleteAction: 'deleteReport', createNewAction: 'createNewReport', idKey: 'report_id');
    }

    public function render()
    {
        return view('components.molecules.sidebars.template-sidebar');
    }
}

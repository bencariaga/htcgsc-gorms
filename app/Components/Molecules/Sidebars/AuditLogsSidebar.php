<?php

namespace App\Components\Molecules\Sidebars;

class AuditLogsSidebar extends TemplateSidebar
{
    public function __construct(public array $items = [], public mixed $files = [], public mixed $selectedFile = null, public array $nameStrip = [])
    {
        parent::__construct(items: $items, files: $files, selectedFile: $selectedFile, title: 'Audit Logs', nameStrip: $nameStrip, fetchAction: 'fetchFile', downloadAction: 'downloadFile');
    }
}

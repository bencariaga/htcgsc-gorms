<?php

namespace App\Components\Atoms\Buttons\ActionButtons;

use App\{Enums\NonDB\AuditLogsStyling, Support\MarkdownToHtmlConverter};
use Illuminate\View\Component;

class AuditLogGroup extends Component
{
    public string $rawText;

    public string $message;

    public string $level;

    public string $markdownSource;

    public string $htmlContent;

    public string $levelClass;

    public function __construct(public mixed $item)
    {
        $this->rawText = data_get($this->item, 'raw_text', '');
        $this->message = data_get($this->item, 'message', '');
        $this->level = data_get($this->item, 'level', 'INFO');
        $this->markdownSource = data_get($this->item, 'markdown', $this->rawText);
        $this->htmlContent = MarkdownToHtmlConverter::parse($this->markdownSource);
        $this->levelClass = AuditLogsStyling::getLevelClasses($this->level);
    }

    public function render()
    {
        return view('components.atoms.buttons.action-buttons.audit-log-group');
    }
}

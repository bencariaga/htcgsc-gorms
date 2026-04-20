<?php

namespace App\Components;

use App\{Enums\NonDB\EmailNotice, Models\User};
use Illuminate\View\Component;

class NoticeEmail extends Component
{
    public array $config;

    public function __construct(public string $type, public User $user)
    {
        $noticeType = EmailNotice::tryFrom($this->type);
        $this->config = $noticeType ? $noticeType->getConfig() : ['icon' => '', 'text' => ''];
    }

    public function render()
    {
        return view('layouts.notice-email');
    }
}

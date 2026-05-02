<?php

namespace App\Mail;

class NoticeAccountActivation extends BaseMailable
{
    protected function defineMailableConfig(): void
    {
        $this->subjectText = 'Your HTCGSC-GORMS Account Has Been Activated';
        $this->viewName = 'emails.notice-account-activation';
    }
}

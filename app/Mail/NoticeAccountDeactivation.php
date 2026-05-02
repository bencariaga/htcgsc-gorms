<?php

namespace App\Mail;

class NoticeAccountDeactivation extends BaseMailable
{
    protected function defineMailableConfig(): void
    {
        $this->subjectText = 'Your HTCGSC-GORMS Account Has Been Deactivated';
        $this->viewName = 'emails.notice-account-deactivation';
    }
}

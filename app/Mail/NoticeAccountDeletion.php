<?php

namespace App\Mail;

class NoticeAccountDeletion extends BaseMailable
{
    protected function defineMailableConfig(): void
    {
        $this->subjectText = 'Your HTCGSC-GORMS Account Has Been Deleted';
        $this->viewName = 'emails.notice-account-deletion';
    }
}

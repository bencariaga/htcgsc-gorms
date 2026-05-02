<?php

namespace App\Actions\GoogleForms;

class GetUrls
{
    public function getSubmissionUrls(): array
    {
        $formOwner = config('mail.mailers.smtp.username');
        $gFormId = config('services.google.form_id');

        return [
            'newTab' => 'target="_blank" rel="noopener noreferrer"',
            'contact' => "https://mail.google.com/mail/?view=cm&fs=1&to={$formOwner}&tf=cm",
            'report' => "https://docs.google.com/forms/d/e/{$gFormId}/reportabuse",
            'about' => 'https://workspace.google.com/products/forms/',
            'gForm' => 'https://docs.google.com/forms/',
        ];
    }

    public function getContactReferrerUrl(): string
    {
        return <<<'JS'
            `https://mail.google.com/mail/?view=cm&fs=1&to=${$store.formPreview.activeSubmission?.['School Email Address (Referrer)'] || ''}&tf=cm`
        JS;
    }
}

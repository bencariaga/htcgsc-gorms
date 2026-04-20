<?php

namespace App\Actions\QrCode;

class GetQrCodeData
{
    public function getBaseUrl(): string
    {
        return $this->getGoogleFormUrl('form_id');
    }

    public function getEditUrl(): string
    {
        return $this->getGoogleFormUrl('form_id_edit', true);
    }

    private function getGoogleFormUrl(string $key, bool $isEdit = false): string
    {
        $prefix = 'https://docs.google.com/forms/d/';
        $base = $isEdit ? $prefix : "{$prefix}e/";
        $suffix = $isEdit ? '/edit' : '/viewform';
        $config = "services.google.{$key}";

        return $base . config($config) . $suffix;
    }
}

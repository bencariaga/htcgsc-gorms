<?php

namespace App\Actions\QrCode;

class DisplayQrCode
{
    public function __construct(protected GetQrCodeData $dataAction, protected GenerateQrCode $generateAction) {}

    public function handle(): string
    {
        return $this->generateAction->handle($this->dataAction->getBaseUrl());
    }
}

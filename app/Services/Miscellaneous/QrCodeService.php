<?php

namespace App\Services\Miscellaneous;

use App\Actions\QrCode\{DownloadQrCode, GenerateQrCode, GetQrCodeActions, GetQrCodeData};

class QrCodeService
{
    public function __construct(protected GetQrCodeData $dataAction, protected GenerateQrCode $generateAction, protected DownloadQrCode $downloadAction, protected GetQrCodeActions $actionsAction) {}

    public function getViewModelData(): array
    {
        $url = $this->dataAction->getBaseUrl();
        $urlEdit = $this->dataAction->getEditUrl();
        $qrCodeData = str($this->generateAction->handle($url))->toBase64();
        $actions = $this->actionsAction->handle($url, $urlEdit);

        return compact('qrCodeData', 'url', 'urlEdit', 'actions');
    }

    public function downloadQrCode()
    {
        return $this->downloadAction->handle();
    }
}

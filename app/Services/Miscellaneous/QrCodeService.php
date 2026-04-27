<?php

namespace App\Services\Miscellaneous;

use App\Actions\QrCode\{DownloadQrCode, GenerateQrCode, GetQrCodeActions, GetQrCodeData};
use Illuminate\Support\Facades\Cache;

class QrCodeService
{
    public function __construct(protected GetQrCodeData $dataAction, protected GenerateQrCode $generateAction, protected DownloadQrCode $downloadAction, protected GetQrCodeActions $actionsAction) {}

    public function getViewModelData(): array
    {
        $url = $this->dataAction->getBaseUrl();
        $urlEdit = $this->dataAction->getEditUrl();
        $qrCodeData = Cache::rememberForever("qrcode_{$url}", $this->getEncodedQrCode(...));
        $actions = $this->actionsAction->handle($url, $urlEdit);

        return compact('qrCodeData', 'url', 'urlEdit', 'actions');
    }

    public function downloadQrCode()
    {
        return $this->downloadAction->handle();
    }

    private function getEncodedQrCode(): string
    {
        $url = $this->dataAction->getBaseUrl();

        return str($this->generateAction->handle($url))->toBase64();
    }
}

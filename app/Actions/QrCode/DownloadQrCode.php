<?php

namespace App\Actions\QrCode;

use Illuminate\Support\Facades\{Cache, Response};

class DownloadQrCode
{
    public function __construct(protected GetQrCodeData $dataAction, protected GenerateQrCode $generateAction) {}

    public function handle(string $filename = 'htcgsc-gorms-qr-code.png')
    {
        $url = $this->dataAction->getBaseUrl();
        $size = 1080;
        $data = Cache::rememberForever("qrcode_raw_{$url}_{$size}", fn () => $this->generateAction->handle($url, $size));

        return Response::streamDownload(fn () => print ($data), $filename, ['Content-Type' => 'image/png']);
    }
}

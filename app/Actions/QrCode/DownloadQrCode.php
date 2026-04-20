<?php

namespace App\Actions\QrCode;

use Illuminate\Support\Facades\Response;

class DownloadQrCode
{
    public function __construct(protected GetQrCodeData $dataAction, protected GenerateQrCode $generateAction) {}

    public function handle(string $filename = 'htcgsc-gorms-qr-code.png')
    {
        $data = $this->generateAction->handle($this->dataAction->getBaseUrl(), 1080);

        return Response::streamDownload(fn () => print ($data), $filename, ['Content-Type' => 'image/png']);
    }
}

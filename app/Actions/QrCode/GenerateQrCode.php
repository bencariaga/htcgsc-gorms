<?php

namespace App\Actions\QrCode;

use App\Traits\Miscellaneous\RendersQRCode;

class GenerateQrCode
{
    use RendersQRCode;

    public function handle(string $value, int $size = 400, float $margin = 3, float $percentage = 0.272): string
    {
        return $this->generateRawQrCode($value, $size, $margin, $percentage);
    }
}

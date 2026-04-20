<?php

namespace App\Traits\Miscellaneous;

use Illuminate\Support\{Facades\File, Str};
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Spatie\Image\Image;

trait RendersQRCode
{
    protected function generateRawQrCode(string $value, int $size = 1080, float $margin = 1, float $percentage = 0.29)
    {
        $logoPath = public_path('images/HTCGSC-GORMS-logo-white.png');
        $tempPath = storage_path('app/temp_qr_' . Str::random(13) . '.png');
        $qrContent = QrCode::format('png')->size($size)->margin($margin)->errorCorrection('H')->color(0, 0, 0);

        if (File::exists($logoPath)) {
            $qrContent = $qrContent->merge($logoPath, $percentage, true);
        }

        $rawPng = $qrContent->generate($value);
        File::put($tempPath, $rawPng);
        Image::load($tempPath)->width($size)->height($size)->save($tempPath);
        $finalImage = File::get($tempPath);
        File::delete($tempPath);

        return $finalImage;
    }
}

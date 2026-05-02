<?php

namespace App\Actions\QrCode;

use App\Enums\NonDB\QrCodeStyling;

class GetQrCodeActions
{
    public function handle(string $url, string $urlEdit): array
    {
        $config = QrCodeStyling::getConfig();
        $items = QrCodeStyling::getItems($url, $urlEdit);

        return collect($items)->map(function ($item) use ($config) {
            $color = $item['color'];
            $isCopy = $color === 'slate';
            $activeIcon = $item['activeIcon'] ?? $item['icon'];
            $activeText = $item['activeText'] ?? $item['text'];
            $class = "text-{$color}-{$config['text']} dark:text-{$color}-{$config['dark']} hover:bg-{$color}-{$config['bg']} dark:hover:bg-{$color}-{$config['bg']}/{$config['opacity']}";
            $containerClass = $isCopy ? 'text-base w-[16rem] pl-[22px] pr-[18px]' : 'text-base w-[14rem] pl-6 pr-4';
            $iconClass = 'h-[20px] w-[20px]';
            $spanClass = $isCopy ? 'ml-[12px]' : 'ml-[10px]';
            $iconWrapper = '';

            return collect($item)->merge(compact('activeIcon', 'activeText', 'class', 'containerClass', 'iconClass', 'spanClass', 'iconWrapper'))->toArray();
        })->all();
    }
}

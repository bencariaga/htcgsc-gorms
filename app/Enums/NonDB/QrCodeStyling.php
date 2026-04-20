<?php

namespace App\Enums\NonDB;

enum QrCodeStyling
{
    public static function getConfig(): array
    {
        return ['text' => '600', 'dark' => '400', 'bg' => '200', 'opacity' => '10'];
    }

    public static function getItems(string $url, string $urlEdit): array
    {
        return [
            ['type' => 'button', 'icon' => 'fas fa-copy', 'text' => 'Copy Google Form Link', 'color' => 'slate', 'activeIcon' => 'fas fa-check text-emerald-500', 'activeText' => 'Link copied!', 'click' => 'copyToClipboard'],
            ['type' => 'link', 'icon' => 'fas fa-edit', 'text' => 'Edit Google Form', 'color' => 'blue', 'href' => $urlEdit],
            ['type' => 'button', 'icon' => 'fas fa-download', 'text' => 'Download QR Code', 'color' => 'green', 'click' => 'download'],
            ['type' => 'link', 'icon' => 'fas fa-eye', 'text' => 'View Google Form', 'color' => 'emerald', 'href' => $url],
        ];
    }
}

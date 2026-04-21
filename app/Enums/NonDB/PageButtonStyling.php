<?php

namespace App\Enums\NonDB;

use App\Traits\Has\HasValues;

enum PageButtonStyling: string
{
    use HasValues;

    case SIDEBAR = 'sidebar';
    case HEADER = 'header';

    public function getMenuItems(): array
    {
        $items = match ($this) {
            self::HEADER => [
                'fa-circle-user' => ['label' => 'User Profile', 'width' => 'w-[165px]'],
                'fa-qrcode' => ['label' => 'Qr Code', 'width' => 'w-[140px]'],
            ],
            self::SIDEBAR => [
                'fa-home' => ['label' => 'Dashboard'],
                'fa-paper-plane' => ['label' => 'Submissions'],
                'fa-users-gear' => ['label' => 'Users'],
                'fa-calendar-check' => ['label' => 'Appointments'],
                'fa-user-graduate' => ['label' => 'Students'],
                'fa-chart-pie' => ['label' => 'Reports'],
                'fa-clipboard-list' => ['label' => 'Audit Logs'],
            ],
        };

        return collect($items)->map(function ($data, $icon) {
            $label = $data['label'] === 'Qr Code' ? 'QR Code' : $data['label'];
            $route = str($label)->lower()->kebab()->append('.index')->toString();
            $width = $data['width'] ?? '';

            return compact('icon', 'label', 'route', 'width');
        })->values()->toArray();
    }
}

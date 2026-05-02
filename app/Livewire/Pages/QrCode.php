<?php

namespace App\Livewire\Pages;

use App\Services\Miscellaneous\QrCodeService;
use Livewire\{Attributes\Layout, Attributes\Title, Component};

#[Title('QR Code')]
#[Layout('layouts.personal-pages', ['padding' => '1rem', 'important' => '!important'])]
class QrCode extends Component
{
    public function download(QrCodeService $service)
    {
        $this->dispatch('notify', type: 'success', message: 'QR code has been <strong>downloaded</strong> successfully.');

        return $service->downloadQrCode();
    }

    public function render(QrCodeService $service)
    {
        return view('livewire.pages.qr-code', $service->getViewModelData());
    }
}

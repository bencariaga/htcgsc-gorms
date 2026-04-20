<?php

namespace App\Livewire\Pages;

use App\Services\Miscellaneous\QrCodeService;
use Livewire\{Attributes\Layout, Attributes\Title, Component};

class QrCode extends Component
{
    public function download(QrCodeService $service)
    {
        $this->dispatch('notify', type: 'success', message: 'QR code has been <strong>downloaded</strong> successfully.');

        return $service->downloadQrCode();
    }

    #[Layout('layouts.personal-pages')]
    #[Title('QR Code')]
    public function render(QrCodeService $service)
    {
        return view('livewire.pages.qr-code', $service->getViewModelData());
    }
}

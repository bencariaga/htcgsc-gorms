@props(['qrCodeData'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center space-y-6 select-none cursor-default']) }} @contextmenu.prevent @dragstart.prevent>
    <div class="relative group pl-6 pr-4 pt-2 pb-4">
        <div class="relative bg-white p-5 rounded-xl transition-all group border-2 border-dashed border-gray-500">
            <img src="data:image/png;base64,{{ $qrCodeData }}" alt="QR Code" class="w-[280px] h-[280px] object-contain">
            <div class="absolute inset-0 z-30"></div>
        </div>
    </div>
</div>

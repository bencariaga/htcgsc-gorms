<div class="flex flex-col items-center justify-center" x-data="qrCodeManager('{{ $url }}')">
    <script src="{{ asset('js/qr-code.js') }}"></script>

    <div class="max-w-[35rem] w-full bg-slate-100 dark:bg-slate-800 shadow-2xl border-2 border-gray-300 dark:border-slate-700 rounded-2xl overflow-hidden">
        <div class="flex justify-center items-center gap-4 px-8 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-100 dark:bg-slate-800/50">
            <span class="text-xl font-bold text-slate-800 dark:text-white">
                HTCGSC-GORMS Google Forms QR Code
            </span>
        </div>

        <x-molecules.data-display.qr-code-display :qr-code-data="$qrCodeData" />

        <x-molecules.navigation.qr-code-actions :actions="$actions" x-bind:copied="copied" />
    </div>

    <div wire:loading wire:target="download">
        <x-molecules.loading-screens.ls-livewire id="loadingDownload" message="Downloading QR Code..."/>
    </div>
</div>

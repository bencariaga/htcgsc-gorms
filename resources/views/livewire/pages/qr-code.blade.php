<div class="flex flex-col items-center justify-center"
    x-data="{
        copied: false,
        url: '{{ $url }}',
        copyToClipboard() {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(this.url).then(() => this.notifySuccess());
            } else {
                let textArea = document.createElement('textarea');
                textArea.value = this.url;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    this.notifySuccess();
                } catch (err) {
                    console.error('Fallback copy failed', err);
                }
                document.body.removeChild(textArea);
            }
        },
        notifySuccess() {
            this.copied = true;
            this.$dispatch('notify', { type: 'success', message: 'Google Form link has been <strong>copied to clipboard</strong>!' });
            setTimeout(() => this.copied = false, 3000);
        }
    }">
    <div class="max-w-[35rem] w-full bg-slate-100 dark:bg-slate-800 shadow-2xl border-2 border-gray-300 dark:border-slate-700 rounded-2xl overflow-hidden">
        <div class="flex justify-center items-center gap-4 px-8 py-4 border-b border-slate-100 dark:border-slate-800 bg-slate-100 dark:bg-slate-800/50">
            <span class="text-xl font-bold text-slate-800 dark:text-white">
                HTCGSC-GORMS Google Forms QR Code
            </span>
        </div>

        <div class="flex flex-col items-center justify-center space-y-6 select-none cursor-default" @contextmenu.prevent @dragstart.prevent>
            <div class="relative group pl-6 pr-4 pt-2 pb-4">
                <div class="relative bg-white p-5 rounded-xl transition-all group border-2 border-dashed border-gray-500">
                    <img src="data:image/png;base64,{{ $qrCodeData }}" alt="QR Code" class="w-[280px] h-[280px] object-contain">
                    <div class="absolute inset-0 z-30"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 mb-1 pl-6 pr-4 pb-6">
            @foreach($actions as $action)
                @if($action['type'] === 'button')
                    <button type="button" @click="{{ $action['click'] === 'download' ? '$wire.download()' : 'copyToClipboard()' }}" class="{{ $action['containerClass'] }} flex justify-start items-center py-2 font-semibold rounded-xl transition-all group {{ $action['class'] }}">
                        <div class="{{ $action['iconWrapper'] }} flex justify-center">
                            <i :class="copied && '{{ $action['text'] }}' === 'Copy Google Form Link' ? '{{ $action['activeIcon'] }}' : '{{ $action['icon'] }}'" class="{{ $action['iconClass'] }} group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="{{ $action['spanClass'] }}">
                            <span x-text="copied && '{{ $action['text'] }}' === 'Copy Google Form Link' ? '{{ $action['activeText'] }}' : '{{ $action['text'] }}'"></span>
                        </span>
                    </button>
                @else
                    <a href="{{ $action['href'] }}" target="_blank" rel="noopener noreferrer" class="{{ $action['containerClass'] }} flex justify-start items-center py-2 font-semibold rounded-xl transition-all group {{ $action['class'] }}">
                        <div class="{{ $action['iconWrapper'] }} flex justify-center">
                            <i class="{{ $action['icon'] }} {{ $action['iconClass'] }} group-hover:scale-110 transition-transform"></i>
                        </div>
                        <span class="{{ $action['spanClass'] }}">{{ $action['text'] }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>

    <div wire:loading wire:target="download">
        <x-molecules.loading-screens.ls-livewire id="loadingDownload" message="Downloading QR Code..."/>
    </div>
</div>

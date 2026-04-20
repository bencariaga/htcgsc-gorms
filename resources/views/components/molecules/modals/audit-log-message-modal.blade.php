@props(['id'])

<div id="{{ $id }}"
    x-data="{
        show: false,
        htmlContent: '',
        plainText: '',
        rawMarkdown: '',
        levelClass: '',
        logDate: '',
        logTime: '',
        copiedText: false,
        copiedMd: false,
        copyToClipboard(content, type) {
            if (!content) return;

            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(content).then(() => {
                    this.notifySuccess(type);
                });
            } else {
                let textArea = document.createElement('textarea');

                textArea.value = content;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';

                document.body.appendChild(textArea);

                textArea.focus();
                textArea.select();

                try {
                    document.execCommand('copy');
                    this.notifySuccess(type);
                } catch (err) {
                    console.error('Fallback copy failed', err);
                }

                document.body.removeChild(textArea);
            }
        },
        notifySuccess(type) {
            const isText = type === 'text';
            const stateKey = isText ? 'copiedText' : 'copiedMd';
            const label = isText ? 'plain text' : 'markdown';

            this[stateKey] = true;

            this.$dispatch('notify', {
                type: 'success',
                message: `Audit log in <strong>${label}</strong> copied to clipboard successfully.`
            });

            setTimeout(() => this[stateKey] = false, 3000);
        }
    }"
    x-show="show"
    x-on:open-audit-log-modal.window="if ($event.detail.id === '{{ $id }}') {
        show = true;
        htmlContent = $event.detail.htmlContent;
        plainText = $event.detail.plainText;
        rawMarkdown = $event.detail.rawMarkdown;
        levelClass = $event.detail.levelClass.replace(/bg-\S+|border-\S+/g, '');
        logDate = $event.detail.date;
        logTime = $event.detail.time;
    }"
    x-on:close-modal.window="if ($event.detail.id === '{{ $id }}') show = false"
    class="fixed inset-0 z-[100] items-center justify-center p-4"
    :class="{ 'flex': show, 'hidden': !show }"
    x-cloak>

    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" x-on:click="show = false"></div>

    <div class="w-full max-h-[40rem] max-w-[50rem] relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden flex flex-col">
        <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex justify-between items-center border-b border-slate-200 dark:border-slate-700">
            <span class="text-xl text-slate-800 dark:text-white font-bold tracking-[0.5px] tabular-nums">
                Audit Log Details | Date: <span x-text="logDate"></span> | Time: <span x-text="logTime"></span>
            </span>

            <button type="button" x-on:click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6 flex-1 flex flex-col min-h-0">
            <div class="bg-slate-100 dark:bg-slate-900/50 p-6 rounded-xl border border-slate-200 dark:border-slate-700 overflow-auto [scrollbar-width:auto] [scrollbar-gutter:stable] [scrollbar-color:rgba(107,114,128,0.8)_transparent] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-500/80">
                <div class="!animate-none whitespace-pre-wrap text-base !text-black dark:!text-white font-normal" :class="levelClass" x-html="htmlContent"></div>
            </div>

            <div class="mt-6 flex justify-evenly items-center gap-6">
                <x-atoms.buttons.button-groups.audit-log-button-group action="copy_text" click="copyToClipboard(plainText, 'text')" active-condition="copiedText" active-text="Copied to clipboard!" class="hover:bg-emerald-100 dark:hover:bg-emerald-900/30 h-[44px] rounded-xl transition-all flex items-center justify-center" />
                <x-atoms.buttons.button-groups.audit-log-button-group action="copy_md" click="copyToClipboard(rawMarkdown, 'md')" active-condition="copiedMd" active-text="Copied to clipboard!" class="hover:bg-red-100 dark:hover:bg-red-900/30 h-[44px] rounded-xl transition-all flex items-center justify-center" />

                <button type="button" x-on:click="show = false" class="w-[10rem] h-[44px] rounded-xl transition-all flex items-center justify-center px-6 py-2 font-bold text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/30">
                    <i class="fas fa-times text-lg mr-[8px]"></i>
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

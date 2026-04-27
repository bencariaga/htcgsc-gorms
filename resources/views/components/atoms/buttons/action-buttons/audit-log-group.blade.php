<div x-data="{
    copiedText: false,
    copiedMd: false,
    copyToClipboard(content, type) {
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
    },
    getPlainText() {
        return @js($message);
    },
    getMarkdown() {
        return @js($markdownSource);
    },
    openModal() {
        this.$dispatch('open-audit-log-modal', {
            id: 'audit-log-modal',
            htmlContent: @js($htmlContent),
            plainText: @js($message),
            rawMarkdown: @js($markdownSource),
            levelClass: @js($levelClass),
            date: @js(data_get($item, 'date', '')),
            time: @js(data_get($item, 'time', '')),
        });
    }
}" class="relative group w-full h-[2.5rem] flex items-center">
    <span class="group-hover:hidden line-clamp-2 text-gray-700 dark:text-gray-300">
        {{ $message }}
    </span>

    <div class="absolute inset-0 z-10 hidden group-hover:flex items-center justify-center gap-3">
        <x-atoms.buttons.button-groups.audit-log-button-group action="view" click="openModal()" />
        <x-atoms.buttons.button-groups.audit-log-button-group action="copy_text" click="copyToClipboard(getPlainText(), 'text')" active-condition="copiedText" active-text="Copied!" />
        <x-atoms.buttons.button-groups.audit-log-button-group action="copy_md" click="copyToClipboard(getMarkdown(), 'md')" active-condition="copiedMd" active-text="Copied!" />
    </div>
</div>

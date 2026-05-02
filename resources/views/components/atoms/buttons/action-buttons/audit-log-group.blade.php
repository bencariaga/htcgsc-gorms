@once <script src="{{ asset('js/audit-logs.js') }}"></script> @endonce

<div x-data="auditLogGroup(@js($message), @js($markdownSource), @js($htmlContent), @js($levelClass), @js(data_get($item, 'date', '')), @js(data_get($item, 'time', '')))" class="relative group w-full h-[2.5rem] flex items-center">
    <span class="group-hover:hidden line-clamp-2 text-gray-700 dark:text-gray-300">
        {{ $message }}
    </span>

    <div class="absolute inset-0 z-10 hidden group-hover:flex items-center justify-center gap-3">
        <x-atoms.buttons.button-groups.audit-log-button-group action="view" click="openModal()" />
        <x-atoms.buttons.button-groups.audit-log-button-group action="copy_text" click="copy('text')" active-condition="copiedText" active-text="Copied!" />
        <x-atoms.buttons.button-groups.audit-log-button-group action="copy_md" click="copy('md')" active-condition="copiedMd" active-text="Copied!" />
    </div>
</div>

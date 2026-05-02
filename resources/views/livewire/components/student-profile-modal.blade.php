<div x-data="{ show: @entangle('show') }" x-on:close-modal.window="if($event.detail.id === '{{ $modalId }}') show = false" x-show="show" class="hidden fixed inset-0 z-[100] items-center justify-center p-4" :class="{ 'flex': show, 'hidden': !show }" x-cloak>
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" x-on:click="show = false"></div>

    <div class="max-w-4xl w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
        <x-molecules.forms.student-profile-form :id="$modalId" :modal="true" />
    </div>
</div>

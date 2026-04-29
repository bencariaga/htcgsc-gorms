<div x-data="{ show: @entangle('show') }" x-show="show" class="hidden fixed inset-0 z-[100] items-center justify-center p-4" :class="{ 'flex': show, 'hidden': !show }" x-cloak>
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-[2px]" x-on:click="show = false"></div>

    <x-molecules.forms.student-profile-form :id="$modalId" :item="null" />
</div>

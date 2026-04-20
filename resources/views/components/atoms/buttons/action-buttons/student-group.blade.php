@props(['item'])

@php
    use Illuminate\Support\Js;
@endphp

<button type="button" @click="$dispatch('open-modal', { id: 'studentProfileModal', student: {{ Js::from($item) }} })" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 font-bold transition-colors">
    Edit
</button>

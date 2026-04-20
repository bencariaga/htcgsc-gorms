@props(['user', 'person'])

@php
    $profilePicture = $user->profile_picture ? asset("storage/{$user->profile_picture}") : null;
@endphp

<a href="{{ route('user-profile.index', $user->user_id ?? '') }}" @contextmenu.prevent @dragstart.prevent {{ $attributes->merge(['class' => 'rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold overflow-hidden border border-gray-400 dark:border-slate-600 shadow-md shrink-0']) }}>
    @if($user->profile_picture)
        <img src="{{ $profilePicture }}" class="h-full w-full object-cover" alt="{{ $person->full_name }}">
    @else
        <span class="{{ $attributes->has('class') && str_contains($attributes->get('class'), 'h-20') ? 'text-xl' : 'text-sm' }}">
            {{ str($person->first_name)->substr(0, 1)->upper() }}
        </span>
    @endif
</a>

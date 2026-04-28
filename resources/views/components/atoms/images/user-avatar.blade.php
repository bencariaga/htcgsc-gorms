<a href="{{ route('user-profile.index', data_get($user, 'user_id')) }}" @contextmenu.prevent @dragstart.prevent {{ $attributes->merge(['class' => "rounded-full bg-emerald-600 flex items-center justify-center text-white font-bold overflow-hidden border border-gray-300 dark:border-slate-700 shadow-md shrink-0 {$class}"]) }}>
    @if(data_get($user, 'profile_picture'))
        <img src="{{ $user->profile_picture_url }}" class="h-full w-full object-cover" alt="{{ data_get($person, 'full_name') }}">
    @else
        <span class="{{ $fontSizeClass }} select-none">
            {{ $initials }}
        </span>
    @endif
</a>

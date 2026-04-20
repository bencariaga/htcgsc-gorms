@props(['item', 'isAdmin', 'fullName', 'config'])

@php
    use App\Enums\AccountStatus;

    $isCurrentlyActive = $item->account_status === AccountStatus::Active;
@endphp

<a type="button" @disabled(!$isAdmin) href="{{ route('user-profile.index', $item->user_id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 font-bold transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
    Edit
</a>

<button type="button" @disabled($isCurrentlyActive && $isAdmin) @click="$dispatch('open-modal', { id: 'confirmationModal', userId: @js($item->user_id), name: @js($fullName), action: @js($isCurrentlyActive ? 'deactivate' : 'activate') })" class="{{ $isCurrentlyActive ? 'text-orange-600 dark:text-orange-400' : 'text-green-600 dark:text-green-400' }} font-bold transition-colors px-1 w-[5.25rem] disabled:opacity-30 disabled:cursor-not-allowed">
    {{ $isCurrentlyActive ? 'Deactivate' : 'Activate' }}
</button>

<button type="button" @disabled($isAdmin) @click="$dispatch('open-modal', { id: 'confirmationModal', {{ $config['id_key'] }}: @js($config['id_val']), action: 'delete', name: @js($fullName) })" class="text-red-600 dark:text-red-400 hover:text-red-800 font-bold transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
    Delete
</button>

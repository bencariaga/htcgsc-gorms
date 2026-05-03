<label {{ $attributes->merge(['class' => 'block text-base font-semibold text-slate-700 dark:text-slate-200']) }}>
    {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
</label>

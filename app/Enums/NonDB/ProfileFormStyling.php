<?php

namespace App\Enums\NonDB;

use App\Traits\Has\HasValues;

enum ProfileFormStyling
{
    use HasValues;

    private const INPUT_BASE = 'w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white';

    private const DIRTY_CLASSES = "isDirty('%s') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'";

    private const ICON_BASE = 'absolute left-4 text-slate-400';

    public static function getCommonClasses(): array
    {
        $input = self::INPUT_BASE;
        $dirty = self::DIRTY_CLASSES;
        $icon = self::ICON_BASE;
        $label = 'block text-base font-semibold text-slate-700 dark:text-slate-200';
        $grid_name = 'grid grid-cols-1 md:grid-cols-4 gap-6';
        $grid_contact = 'grid grid-cols-1 md:grid-cols-10 gap-6';

        return compact('input', 'dirty', 'icon', 'label', 'grid_name', 'grid_contact');
    }

    public static function definitions(): array
    {
        $last_name = self::field('Last Name', 'fa-user', true, 'md:col-span-1');
        $first_name = self::field('First Name', 'fa-user', true, 'md:col-span-1', ['@keydown.space.prevent', '@input="sanitize"', '@blur="sanitize"']);
        $middle_name = self::field('Middle Name', 'fa-user', false, 'md:col-span-1');
        $email_address = self::field('Email Address', 'fa-envelope', true, 'md:col-span-6', ['@keydown.space.prevent', '@input="sanitize"', '@blur="sanitize"'], 'email');
        $phone_number = self::field('Phone Number', 'fa-phone', false, 'md:col-span-4', ['inputmode="tel"', '@input="sanitize"', '@blur="sanitize"']);

        return compact('last_name', 'first_name', 'middle_name', 'email_address', 'phone_number');
    }

    public static function sections(): array
    {
        $all = collect(self::definitions())->map(fn ($field, $name) => ['name' => $name, ...$field]);
        $main = ['grid' => 'grid grid-cols-1 md:grid-cols-4', 'fields' => $all->only(['last_name', 'first_name', 'middle_name'])->values()->all()];
        $contact = ['grid' => 'grid grid-cols-1 md:grid-cols-10', 'fields' => $all->only(['email_address', 'phone_number'])->values()->all()];

        return compact('main', 'contact');
    }

    private static function field(string $label, string $icon, bool $required, string $colSpan, array $attributes = [], string $type = 'text'): array
    {
        $icon = "fas $icon " . self::ICON_BASE;
        $extra = collect($attributes)->join(' ');
        $class = self::INPUT_BASE;

        return compact('label', 'icon', 'required', 'colSpan', 'extra', 'type', 'class');
    }
}

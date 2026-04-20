<?php

namespace App\Enums\NonDB;

use Illuminate\Support\Collection;

enum AuthenticationStyling: string
{
    case INPUT_CANVAS = 'w-full h-[3.5rem] pl-12 py-3 border-2 border-gray-400 rounded-xl bg-gray-200/80 focus:outline-none focus:border-emerald-500 focus:bg-white transition-all';
    case INPUT_ERROR = 'border-red-500';
    case PASSWORD_PADDING_RIGHT = 'pr-12';
    case DEFAULT_PADDING_RIGHT = 'pr-4';
    case ICON_BASE = 'fas absolute left-4 text-gray-500';
    case LABEL_BASE = 'block text-base font-semibold text-slate-700';
    case ERROR_TEXT = 'text-red-500 text-base font-semibold';

    public function is(string $current, string $target): bool
    {
        return $current === $target;
    }

    public static function sections(string $context = 'register'): array
    {
        $allSections = [
            'register' => [
                'names' => [
                    'grid' => 'md:grid-cols-4',
                    'fields' => [
                        ['label' => 'First Name', 'model' => 'form.firstName', 'placeholder' => 'Your first name', 'required' => true, 'icon' => 'fa-user', 'span' => 'md:col-span-1'],
                        ['label' => 'Last Name', 'model' => 'form.lastName', 'placeholder' => 'Your last name', 'required' => true, 'icon' => 'fa-user', 'span' => 'md:col-span-1'],
                        ['label' => 'Middle Name', 'model' => 'form.middleName', 'placeholder' => 'Your middle name', 'required' => false, 'icon' => 'fa-user', 'span' => 'md:col-span-1'],
                        ['label' => 'Suffix', 'model' => 'form.suffix', 'type' => 'suffix', 'icon' => 'fa-user', 'span' => 'md:col-span-1'],
                    ],
                ],
                'contact' => [
                    'grid' => 'md:grid-cols-2',
                    'fields' => [
                        ['label' => 'Email Address', 'model' => 'form.email', 'placeholder' => 'Your email address', 'type' => 'email', 'required' => true, 'icon' => 'fa-envelope', 'span' => 'md:col-span-1'],
                        ['label' => 'Phone Number', 'model' => 'form.phoneNumber', 'placeholder' => 'Your phone number (optional)', 'required' => false, 'icon' => 'fa-phone', 'span' => 'md:col-span-1'],
                    ],
                ],
                'auth' => [
                    'grid' => 'md:grid-cols-3',
                    'fields' => [
                        ['label' => 'Password', 'model' => 'form.password', 'placeholder' => 'Minimum: 8 characters', 'type' => 'password', 'required' => true, 'icon' => 'fa-lock', 'span' => 'md:col-span-1'],
                        ['label' => 'Confirm Password', 'model' => 'form.password_confirmation', 'placeholder' => 'Repeat that password', 'type' => 'password', 'required' => true, 'icon' => 'fa-check-double', 'span' => 'md:col-span-1'],
                    ],
                ],
            ],
            'login' => [
                'credentials' => [
                    'grid' => 'grid-cols-1',
                    'fields' => [
                        ['label' => 'Email Address or Phone Number', 'model' => 'email', 'placeholder' => 'Enter your email address or phone number.', 'required' => true, 'icon' => 'fa-id-card', 'span' => 'w-full'],
                        ['label' => 'Password', 'model' => 'password', 'type' => 'password', 'placeholder' => 'Enter your password.', 'required' => true, 'icon' => 'fa-lock', 'span' => 'w-full'],
                    ],
                ],
            ],
            'forgot-password' => [
                'reset' => [
                    'grid' => 'grid-cols-1',
                    'fields' => [
                        ['label' => 'Full Username', 'model' => 'full_name', 'placeholder' => 'Enter your full name to verify.', 'required' => true, 'icon' => 'fa-user', 'span' => 'w-full'],
                        ['label' => 'Email Address or Phone Number', 'model' => 'identifier', 'placeholder' => 'Enter your email address or phone number.', 'required' => true, 'icon' => 'fa-id-card', 'span' => 'w-full'],
                        ['label' => 'New Password', 'model' => 'newPassword', 'type' => 'password', 'placeholder' => 'Minimum is 8 characters.', 'required' => true, 'icon' => 'fa-lock', 'span' => 'w-full'],
                        ['label' => 'Confirm New Password', 'model' => 'newPassword_confirmation', 'type' => 'password', 'placeholder' => 'Repeat that password.', 'required' => false, 'icon' => 'fa-check-double', 'span' => 'w-full'],
                    ],
                ],
            ],
            'otp' => [
                'verification' => [
                    'grid' => 'flex justify-between gap-2',
                    'fields' => Collection::range(0, 5)->map(fn ($i) => ['model' => "otp_array.$i", 'type' => 'otp', 'index' => $i, 'span' => 'w-12 h-14'])->all(),
                ],
            ],
        ];

        return $allSections[$context] ?? $allSections['register'];
    }
}

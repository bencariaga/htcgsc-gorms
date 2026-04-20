<?php

namespace App\Enums\NonDB;

use Illuminate\Support\{Arr, Reflector, Str};

enum GoogleFormsStyling: string
{
    public static function infoSections(?string $key = null): array|string|null
    {
        $sections = [
            'REFERRER' => 'The referrer is someone who direct the attention of someone else you want to talk with the guidance counselor.',
            'REFERRAL' => 'The referral is someone whose case has been referred by the referrer to the guidance counselor. The referral can be yourself or someone else.',
        ];

        return $key ? ($sections[$key] ?? null) : $sections;
    }

    public static function fields(): array
    {
        $fields = ['Last Name' => 'required', 'First Name' => 'required', 'Middle Name' => 'nullable', 'School Email Address' => ['required', 'email'], 'Phone Number' => 'nullable'];

        return collect($fields)->map(function ($rules, $label) {
            $ruleString = Arr::accessible($rules) ? Arr::join($rules, '|') : $rules;

            return ['label' => $label, 'required' => Str::contains($ruleString, 'required'), 'type' => Str::contains($ruleString, 'email') ? 'email' : 'text'];
        })->values()->toArray();
    }

    public static function headerButtons(): array
    {
        return [
            'navigation' => [
                [
                    'click' => '$store.formPreview.activeSubmission = null',
                    'icon' => 'fa-arrow-left',
                    'label' => 'Back to Submissions',
                ],
            ],
            'actions' => [
                ['method' => 'downloadLog', 'icon' => 'fa-download', 'label' => 'Download as Log'],
                ['method' => 'downloadPdf', 'icon' => 'fa-file-pdf', 'label' => 'Download as PDF'],
                ['method' => 'downloadImage', 'icon' => 'fa-image', 'label' => 'Download as Image'],
            ],
        ];
    }

    public static function footerLinks(array $urls = []): array
    {
        $config = [
            'gForm' => ['text' => 'Create your own Google Form', 'class' => 'underline'],
            'contact' => ['text' => 'Contact form owner', 'prefix' => 'This form was created inside of Holy Trinity College of General Santos City Inc. — '],
            'report' => ['text' => 'Report', 'prefix' => 'Does this form look suspicious? '],
            'about' => ['isImage' => true],
        ];

        return collect($config)->map(fn ($data, $key) => collect($data)->merge(['url' => $urls[$key] ?? '#'])->toArray())->all();
    }

    public static function variables(array $urls = []): object
    {
        $data = [];

        foreach (['infoSections', 'fields', 'headerButtons', 'footerLinks', 'referralTypes', 'personSuffixes', 'appointmentTimes'] as $key) {
            $data[$key] = match (true) {
                $key === 'headerButtons' => self::headerButtons(),
                $key === 'footerLinks' => self::footerLinks($urls),
                Str::endsWith($key, 's') && !Reflector::isCallable([self::class, $key]) => ('App\\Enums\\' . Str::studly(Str::singular($key)))::cases(),
                default => self::$key(),
            };
        }

        return (object) $data;
    }
}

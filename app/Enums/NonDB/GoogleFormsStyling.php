<?php

namespace App\Enums\NonDB;

use App\Traits\Has\HasValues;
use Illuminate\Support\{Arr, Reflector};

enum GoogleFormsStyling: string
{
    use HasValues;

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
            $ruleString = Arr::accessible($rules) ? collect($rules)->join('|') : $rules;

            return ['label' => $label, 'required' => str($ruleString)->contains('required'), 'type' => str($ruleString)->contains('email') ? 'email' : 'text'];
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
                str($key)->endsWith('s') && !Reflector::isCallable([self::class, $key]) => ('App\\Enums\\' . str($key)->singular()->studly())::cases(),
                default => self::$key(),
            };
        }

        return (object) $data;
    }
}

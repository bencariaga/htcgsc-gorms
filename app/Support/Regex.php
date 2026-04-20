<?php

namespace App\Support;

class Regex
{
    public static array $markdownPatterns = [
        'code_block' => '/```(\w+)?\n([\s\S]*?)\n```/',
        'blockquote' => '/^> (.*)$/m',
        'heading' => '/^(#{1,6})\s+(.*)$/m',
        'bold_italic' => '/\*\*\*(.*?)\*\*\*/',
        'bold' => '/\*\*(.*?)\*\*/',
        'italic' => '/\*(.*?)\*/',
        'strikethrough' => '/~~(.*?)~~/',
        'image' => '/\!\[(.*?)\]\((.*?)\)/',
        'link' => '/\[(.*?)\]\((.*?)\)/',
        'inline_code' => '/`(.*?)`/',
        'list' => '/^([ ]{0,3})([-*+]|\d+\.)\s+(.*)$/m',
        'list_merge' => '/<\/(ul|ol)>\n<\1>/',
        'html_block_tags' => '/^<(h[1-6]|pre|blockquote|ul|ol|li|table|tr|div|p)/',
    ];

    public static array $htmlPatterns = [
        'blockquote' => '<blockquote><p>$1</p></blockquote>',
        'bold_italic' => '<strong><em>$1</em></strong>',
        'bold' => '<strong>$1</strong>',
        'italic' => '<em>$1</em>',
        'strikethrough' => '<del>$1</del>',
        'image' => '<img src="$2" alt="$1">',
        'link' => '<a href="$2">$1</a>',
        'inline_code' => '<code>$1</code>',
        'list_merge' => "\n",
    ];

    public static function markdown(string $key): ?string
    {
        return self::$markdownPatterns[$key] ?? null;
    }

    public static function html(string $key): ?string
    {
        return self::$htmlPatterns[$key] ?? null;
    }

    public static function userName(): string
    {
        return '/^\S+$/';
    }

    public static function firstName(): string
    {
        return '/^\S+$/';
    }

    public static function philippineMPN(): string
    {
        return '/^(09|\+639|639)\d{9}$/';
    }

    public static function nonDigits(): string
    {
        return '/[^0-9]/';
    }

    public static function prefix(string $prefix, int $digits): string
    {
        return "/^{$prefix}\d{{$digits}}$/";
    }

    public static function otp(): string
    {
        return '/^[0-9]+$/';
    }

    public static function appKey(): string
    {
        return '/^APP_KEY=.*$/m';
    }

    public static function appKeyPrefix(): string
    {
        return 'APP_KEY=';
    }

    public static function googleFormLogPattern(): string
    {
        return static::logPattern('Google Form Submission Data', '(?=\s*\[\d{4}-\d{2}-\d{2}|$)');
    }

    public static function reportLogPattern(): string
    {
        return static::logPattern('Report Data', '\s*');
    }

    private static function logPattern(string $logIdentifier, string $tail): string
    {
        $appEnv = config('app.env', 'local');
        $levelName = '[A-Z]+';

        return "/{$appEnv}\.{$levelName}: {$logIdentifier}:\s*(?<json>\{.*?\}){$tail}/sm";
    }

    public static function singularizeAction(): string
    {
        return '/s(?=[A-Z])|s$/';
    }

    public static function pluralizeAction(): string
    {
        return '/(?<=[a-z])(?=[A-Z])|$/';
    }
}

<?php

namespace App\Support;

class MarkdownToHtmlConverter
{
    public static function parse(string $text): string
    {
        $simpleReplacements = ['blockquote', 'bold_italic', 'bold', 'italic', 'strikethrough', 'image', 'link', 'inline_code', 'list_merge'];

        $string = str($text)->replaceMatches(Regex::markdown('code_block'), function ($matches) {
            $lang = $matches[1] ?: 'plaintext';
            $code = str($matches[2])->trim()->toHtmlString();

            return "<pre><code class=\"lang-{$lang}\">{$code}</code></pre>";
        });

        foreach ($simpleReplacements as $key) {
            $string = $string->replaceMatches(Regex::markdown($key), Regex::html($key));
        }

        $processed = $string->replaceMatches(Regex::markdown('heading'), function ($matches) {
            $level = str($matches[1])->length();
            $id = str($matches[2])->slug();

            return "<h{$level} id=\"{$id}\">{$matches[2]}</h{$level}>";
        })->replaceMatches(Regex::markdown('list'), function ($matches) {
            $tag = str(str($matches[2])->before('.'))->is('*[0-9]*') ? 'ol' : 'ul';

            return "<{$tag}><li>{$matches[3]}</li></{$tag}>";
        })->explode("\n")->map(function ($line) {
            $trimmed = str($line)->trim();

            if ($trimmed->isNotEmpty() && !$trimmed->isMatch(Regex::markdown('html_block_tags'))) {
                return "<p>{$line}</p>";
            }

            return $line;
        })->implode("\n");

        return str($processed)->trim()->toString();
    }
}

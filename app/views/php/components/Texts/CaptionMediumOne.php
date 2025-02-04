<?php

namespace Project\App\Views\Php\Components\Texts;

class CaptionMediumOne
{
    public static function render(string $content, string $lightcolor, string $darkcolor, ?string $align = null, ?string $width = null, ?string $mt = null, ?string $mr = null, ?string $mb = null, ?string $ml = null, ?string $id = ""): void
    {
        echo <<<HTML
        <p class="CaptionMediumOne text-{$lightcolor} dark:text-{$darkcolor} text-{$align} w-{$width} mt-{$mt} mr-{$mr} mb-{$mb} ml-{$ml}" id="{$id}">$content</p>
        HTML;
    }
}
<?php

namespace Project\App\Views\Php\Components\Texts;

class TextRowContainer
{
    public static function render(string $label, string $content, string $lightcolorcontent, string $darkcolorcontent, string $id = '' , string $name = ''): void
    {
        echo <<<HTML
        <div class="flex gap-[29px]">
            <p class="text-onBackgroundTwo min-w-[140px] dark:text-darkOnBackgroundTwo leading-none BodyTwo text-right">$label</p>
            <p id="$id" name="$name" class="w-[260px] text-{$lightcolorcontent} dark:text-{$darkcolorcontent} leading-none BodyTwo">$content</p>
        </div>
        HTML;
    }
}
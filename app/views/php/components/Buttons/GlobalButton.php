<?php

namespace Project\App\Views\Php\Components\Buttons;

class GlobalButton
{
    public static function render(string $content, string $class, string $extras): void
    {
        echo <<<HTML
        <button class="{$class}" $extras>
            $content
        </button>
        HTML;
    }
}
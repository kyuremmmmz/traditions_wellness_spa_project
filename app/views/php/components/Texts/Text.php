<?php

namespace Project\App\Views\Php\Components\Texts;

class Text
{
    public static function render(string $id, string $name, string $class, $content): void
    {
        echo <<<HTML
        <p id="{$id}" name="{$name}" class="{$class}">
            $content
        </p>
        HTML;
    }
}
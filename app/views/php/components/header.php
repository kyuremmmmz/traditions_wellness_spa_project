<?php

namespace Project\App\Views\Php\Components;

class Header
{
    public static function render(?string $className = null): void
    {
        $classAttribute = $className ? " class=\"$className\"" : '';
        echo <<<HTML
        <div{$classAttribute}>
            test
        </div>
        HTML;
    }
}
<?php

namespace Project\App\Views\Php\Components\Button;

class GlobalButton
{
    public static function render(?string $className = null): void
    {
        // Render the component starting with a <div>
        $classAttribute = $className ? " class=\"$className\"" : '';
        echo <<<HTML
        <div{$classAttribute}>
            kupal
        </div>
        HTML;
    }
}
<?php

namespace Project\App\Views\Php\Components;

class DivCards
{
    public static function render(?string $className = null): void
    {
        // Render the component starting with a <div>
        $classAttribute = $className ? " class=\"$className\"" : '';
        echo <<<HTML
        <div{$classAttribute}>
            <!-- Add your content here -->
        </div>
        HTML;
    }
}
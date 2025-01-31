<?php

namespace Project\App\Views\Php\Components;

class GlobalHideComponent
{
    public static function render(?string $className = null): void
    {
        echo <<<HTML
        <div>
            <!-- Add your content here -->
        </div>
        HTML;
    }
}
<?php

namespace Project\App\Views\Php\Components;

class Header
{
    public static function render(?string $className = null): void
    {
        $classAttribute = $className ? " class=\"$className\"" : '';
        echo <<<HTML
        <div{$classAttribute}>
            <p class="text-white text-center"><</p><p class="text-white text-center">Return to User Management</p>
        </div>
        HTML;
    }
}
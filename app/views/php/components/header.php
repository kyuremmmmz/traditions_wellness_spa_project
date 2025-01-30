<?php

namespace Project\App\Views\Php\Components;

class Header
{
    public static function render(?string $className = null): void
    {
        $classAttribute = $className ? " class=\"$className\"" : '';
        echo <<<HTML
        <div{$classAttribute}>
            <div class="flex items-center gap-2">
                <p class="text-center text-white">&lt;</p>
                <p class="text-center text-white">Return to User Management</p>
            </div>
            <button class="px-4 py-2 text-black duration-300 bg-white rounded-full hover:bg-secondary" onclick="themeHandler()" id="buttontheme" type="button">
                Light
            </button>
        </div>
        HTML;
    }
}

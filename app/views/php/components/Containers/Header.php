<?php

namespace Project\App\Views\Php\Components\Containers;

use Project\App\Views\Php\Components\Assets\MiniLogo; // Import MiniLogo

class Header //NOT FINISHEd
{
    public static function render(string $HeaderChoice): void
    {
        echo <<<HTML
        <header class="flex">
            <button class="px-4 py-2 text-pink duration-300 red rounded-full border-[1px]" 
                    onclick="themeHandler()" id="buttontheme" type="button">
                Light
            </button>
        HTML;

        switch ($HeaderChoice) {
            case "Small":
                MiniLogo::render(); // Call MiniLogo correctly
                break;
            default:
                // You can add a default action here if needed
                break;
        }

        echo <<<HTML
        </header>
        HTML;
    }
}

<?php

namespace Project\App\Views\Php\Components\Containers;

use Project\App\Views\Php\Components\Assets\SubmarkLogo; // Import MiniLogo

class Header //NOT FINISHEd
{
    public static function render(string $HeaderChoice): void
    {
        echo <<<HTML
        <header class="flex justify-center items-center py-[16px]">
        HTML;

        switch ($HeaderChoice) {
            case "Small":
                SubmarkLogo::render("[73px]", '[32px]', '', ''); // Call MiniLogo correctly
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

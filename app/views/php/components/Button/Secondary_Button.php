<?php

namespace Project\App\Views\Php\Components\Button;

class Secondary_Button
{
    public static function render(string $label, string $className = ''): void
    {
        $classes = "px-4 py-2 bg-blue text-white font-semibold rounded hover:bg-blue-600 $className";
        echo <<<HTML
        <button class="$classes">
            $label
        </button>
        HTML;
    }
}

<?php

namespace Project\App\Views\Php\Components\Button;

class GlobalButton
{
    public static function render(string $label, string $className = ''): void
    {
        echo <<<HTML
        <button>
            $label
        </button>
        HTML;
    }
}

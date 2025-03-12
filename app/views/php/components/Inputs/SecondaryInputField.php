<?php

namespace Project\App\Views\Php\Components;

class SecondaryInputField
{
    public static function render(string $fieldChoice, string $content, string $placeholder, $options, ): void
    {
        
        echo <<<HTML
        <div class="flex gap-[16px]">
        </div>
        HTML;
    }
}
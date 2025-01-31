<?php

namespace Project\App\Views\Php\Components;

class SingleCard
{
    public static function render(?string $className = null): void
    {
        echo <<<HTML
        <div class="">
            <!-- Add your content here -->
        </div>
        HTML;
    }
}
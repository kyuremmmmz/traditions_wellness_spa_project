<?php

namespace Project\App\Views\Php\Components\Banner;

class Small_Banner
{
    public static function render(string $errorTitle, string $errorDescription): void
    {
        // Render the component starting with a <div>
        echo <<<HTML
        <div class="w-[380px] h-[96px] border-[1px] border-border bg-background" id="smallBanner">
            <!-- Add your content here -->
        </div>
        HTML;
    }
}
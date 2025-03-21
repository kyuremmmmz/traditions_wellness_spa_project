<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class ActionButton
{
    public static function render(string $iconChoice, string $content, string $id): void
    {
        // Capture the icon component output
        ob_start();
        IconChoice::render($iconChoice, '16px', '16px', '', 'onPrimary', 'darkOnPrimary');
        $iconHtml = ob_get_clean();

        echo '<button class="text-onPrimary dark:text-darkOnPrimary transition-all ease-in-out BodyTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover disabled:bg-secondaryVariant rounded-[6px] w-[219px] min-w-[219px] h-[40px]" id="' . $id . '">
            <div class="flex gap-[8px] w-[full] items-center justify-center">
                ' . $iconHtml . '
                ' . $content . '
            </div>
        </button>';
    }
}
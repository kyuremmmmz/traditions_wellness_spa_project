<?php

namespace Project\App\Views\Php\Components\Buttons;

class GlobalButton
{
    public static function render(string $choice, string $content, ?string $extraAttributes = null): void
    {
        $class = "";
        switch ($choice) {
            case "primary":
                $class="text-onPrimary dark:text-darkOnPrimary transition-all ease-in-out text-BodyMediumTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover disabled:bg-secondaryVariant dark:disabled:bg-darkSecondaryVariant rounded-[6px] w-[148px] h-[40px]";
                break;
            case "secondary":
                $class="";
                break;
        }
        echo '<button class="' . $class . '" ' . $extraAttributes . '>';
        echo $content;
        echo '</button>';
    }
}
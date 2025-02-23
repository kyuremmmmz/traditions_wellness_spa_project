<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\Text;

class GlobalButton
{
    public static function render(string $choice, string $content, ?string $extraAttributes = null, string $iconChoice = "", ?string $id = null): void
    {
        $class = "";
        switch ($choice) {
            case "primary":
                $class="text-onPrimary dark:text-darkOnPrimary transition-all ease-in-out text-BodyMediumTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover disabled:bg-secondaryVariant dark:disabled:bg-darkSecondaryVariant rounded-[6px] w-[148px] h-[40px]";
                break;
            case "secondary":
                $class="";
                break;
            case "navigationMain":
                $class="";
                break;
            case "navigationSecondaryTop":
                $class="w-full rounded-tr-[5px] rounded-tl-[5px] h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface";
                break;
            case "navigationSecondaryMiddle":
                $class="w-inherit h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface";
                break;
            case "navigationSecondaryBottom":
                $class="w-inherit rounded-br-[5px] rounded-bl-[5px] h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface";
                break;
            case "navigationSecondary":
                $class="w-inherit rounded-[5px] h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface";
                break;
        }
        echo '<button class="' . $class . '" ' . $extraAttributes . ' id="' . $id . '">';
        if ($choice == "navigationSecondaryTop" || $choice == "navigationSecondaryBottom" || $choice == "navigationSecondaryMiddle" || $choice == "navigationSecondary") {
            echo IconChoice::render($iconChoice, '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
        }
        echo Text::render('', '', 'BodyMediumTwo leading-none w-full text-onSurface dark:text-darkOnSurface px-[10px]', $content);
        if ($choice == "navigationSecondaryTop" || $choice == "navigationSecondaryBottom" || $choice == "navigationSecondaryMiddle" || $choice == "navigationSecondary") {
            echo IconChoice::render('chevronRightSmall', '[10px]', '[10px] rotate-180', '', 'onSurface', 'darkOnSurface');
        }
        echo '</button>';
    }
}
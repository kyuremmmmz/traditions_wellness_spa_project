<?php

namespace Project\App\Views\Php\Components\Icons;

class IconChoice
{
    public static function render(
        string $choice, 
        string $width = "", 
        string $height = "", 
        string $fill = "", 
        string $lightstroke = " asda", 
        string $darkstroke = "", 
        string $bgcolor = "", 
        string $darkbgcolor = "", 
        string $bgcolorhighlight = "", 
        string $darkbgcolorhighlight = "", 
        string $px = "[0px]", 
        string $py = "[0px]"
    ): void {
        switch ($choice) {
            case "logoutBig":
                // You can define an icon here if needed
                $icon = "logoutBig";
                break;
            case "exitSmall":
                $icon = '
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current text-secondaryVariant dark:text-darkSecondaryVariant">
                        <path d="M13 1L1 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 1L13 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "alertBig":
                $icon = '
                    <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M18 34C26.8366 34 34 26.8366 34 18C34 9.16344 26.8366 2 18 2C9.16344 2 2 9.16344 2 18C2 26.8366 9.16344 34 18 34Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 11.6001V18.0001" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18 24.3999H18.016" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "leftArrow":
                $icon = '
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M15 8H1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 15L1 8L8 1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "uploadBig":
                $icon = '
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">>
                        <path d="M26 18V23.3333C26 24.0406 25.719 24.7189 25.219 25.219C24.7189 25.719 24.0406 26 23.3333 26H4.66667C3.95942 26 3.28115 25.719 2.78105 25.219C2.28095 24.7189 2 24.0406 2 23.3333V18" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.6666 8.66667L14 2L7.33331 8.66667" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2V18" stroke="" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
        };

        // Modify the SVG content with dynamic classes
        echo preg_replace_callback('/class="([^"]+)"/', function($matches) use ($width, $height, $fill, $lightstroke, $darkstroke, $bgcolor, $darkbgcolor, $bgcolorhighlight, $darkbgcolorhighlight, $px, $py) {
            $classes = $matches[1];

            // Add the dynamic classes here
            $classes .= " w-{$width} h-{$height} fill-{$fill} text-{$lightstroke} dark:text-{$darkstroke} bg-{$bgcolor} dark:bg-{$darkbgcolor} hover:bg-{$bgcolorhighlight} dark:hover:bg-{$darkbgcolorhighlight} px-{$px} py-{$py} rounded-[6px]";
            
            return 'class="' . $classes . '"';
        }, $icon);
    }
}

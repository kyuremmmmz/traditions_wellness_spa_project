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
            case 'miniCircle':
                $icon =
                    '<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-">
                        <circle cx="4" cy="4" r="4" fill=""/>
                    </svg>
                ';  
                break;
            case 'eyeClose';
                $icon = '
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M9.87988 9.88C9.58514 10.1547 9.34873 10.4859 9.18476 10.8539C9.02079 11.2218 8.93262 11.6191 8.92552 12.0219C8.91841 12.4247 8.99251 12.8248 9.14339 13.1984C9.29428 13.5719 9.51885 13.9113 9.80373 14.1962C10.0886 14.481 10.4279 14.7056 10.8015 14.8565C11.175 15.0074 11.5752 15.0815 11.978 15.0744C12.3808 15.0673 12.778 14.9791 13.146 14.8151C13.514 14.6512 13.8452 14.4148 14.1199 14.12"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.73 5.08C11.1513 5.02751 11.5754 5.00079 12 5C19 5 22 12 22 12C21.5529 12.9571 20.9922 13.8569 20.33 14.68" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.61 6.60999C4.62125 7.96461 3.02987 9.82524 2 12C2 12 5 19 12 19C13.9159 19.0051 15.7908 18.4451 17.39 17.39" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2 2L22 22" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case 'eyeOpen';
                $icon = '
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current">
                        <path d="M2 12C2 12 5 5 12 5C19 5 22 12 22 12C22 12 19 19 12 19C5 19 2 12 2 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                ';
                break;
            case "uploadBig":
                $icon = '
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current text-primary dark:text-darkPrimary">
                        <path d="M26 18V23.3333C26 24.0406 25.719 24.7189 25.219 25.219C24.7189 25.719 24.0406 26 23.3333 26H4.66667C3.95942 26 3.28115 25.719 2.78105 25.219C2.28095 24.7189 2 24.0406 2 23.3333V18" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M20.6666 8.66667L14 2L7.33331 8.66667" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 2V18" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
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

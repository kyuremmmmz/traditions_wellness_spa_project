<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class ImgUploadButton
{
    public static function render(?string $className = null): void
    {
        echo '<button class="w-[128px] mt-[90px] h-[128px] bg-background dark:bg-darkBackground rounded-[128px] hover:bg-secondary dark:hover:bg-darkSecondary border-[2px] border-border dark:border-darkBorder flex justify-center items-center">';
                    IconChoice::render('uploadBig', '[24px]', '[24px]', '', '[primary]', '[darkPrimary]'); //'uploadBig', '[24px]', '[24px]', '', 'primary', 'darkPrimary'
        echo  '</button>';
    }
}
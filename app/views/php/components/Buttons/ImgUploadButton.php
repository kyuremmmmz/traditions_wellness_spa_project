<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class ImgUploadButton
{
    public static function render(?string $className = null): void
    {
        echo '<label for="imgUpload" class="w-[128px] mt-[90px] h-[128px] bg-background dark:bg-darkBackground rounded-[128px] hover:bg-secondary dark:hover:bg-darkSecondary border-[2px] border-border dark:border-darkBorder flex justify-center items-center cursor-pointer">';
        IconChoice::render('uploadBig', '[24px]', '[24px]', '', '[primary]', '[darkPrimary]');
        echo        '<input type="file" id="imgUpload" name="imgUpload" class="hidden" accept="image/*" />';
        echo  '</label>';
    }
}

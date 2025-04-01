<?php

namespace Project\App\Views\Php\Components\Headers;

use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Texts\LastUpdated;

class PageTitle
{
    public static function render(string $iconChoiceMedium, string $title): void
    {
        echo '<section class="flex h-[50px]">
                <div class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground transition-all rounded-[6px] flex justify-center items-center">';
        echo        IconChoice::render($iconChoiceMedium, '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface');
        echo '  </div>
                <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">';
        echo        Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', $title);
        echo        LastUpdated::render();
        echo    '</div>
            </section>';
    }
}
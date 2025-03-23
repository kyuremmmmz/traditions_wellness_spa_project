<?php

namespace Project\App\Views\Php\Components\Buttons;

class AddonItemButton
{
    public static function render(string $Headline = 'Headline', string $price = '0', string $idandname = ''): void
    {
        echo <<<HTML
        <button id="$idandname" type="button" class="w-[365px] h-[56px] flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]">
            <div class="flex flex-col gap-[8px] w-[365px] h-full justify-center items-center">
                <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">$Headline</p>
                <p class="CaptionOne text-primary dark:text-darkPrimary text-left leading-none w-full truncate">₱$price</p>
            </div>
        </button>
        HTML;
    }
}
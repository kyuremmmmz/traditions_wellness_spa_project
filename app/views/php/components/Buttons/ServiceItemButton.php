<?php

namespace Project\App\Views\Php\Components\Buttons;

class ServiceItemButton
{
    public static function render(string $imgsrc = "", string $Headline = 'Headline', string $description = 'Description', string $rating = '0.0', string $price = '0', string $idandname = ''): void
    {
        echo <<<HTML
        <button id="$idandname" type="button" class="w-[365px] h-[84px] flex p-[10px] gap-[16px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface rounded-[6px]">
            <div class="w-[64px]">
                <img src="$imgsrc" class="w-[64px] h-[64px] rounded-[6px] bg-primary dark:bg-primary">
            </div>
            <div class="flex flex-col gap-[8px] w-[calc(100%-80px)] h-full justify-center items-center">
                <p class="BodyTwo text-onBackground dark:text-darkOnBackground leading-none text-left w-full truncate">$Headline</p>
                <p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none w-full truncate">$description</p>
                <div class="flex gap-[8px] w-full">
                    <div class="flex gap-[4px]">
                        <p class="CaptionOne text-onBackground lea₱ding-none dark:text-darkOnBackground truncate">$rating</p>
                        <?php IconChoice::render('star', '[10px]', '[10px]', '', 'orange', 'orange')?>
                    </div>
                    <p class="CaptionMediumOne text-primary dark:text-darkPrimary leading-none w-full text-left">₱$price</p>
                </div>
            </div>
        </button>
        HTML;
    }
}
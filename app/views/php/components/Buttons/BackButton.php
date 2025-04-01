<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class BackButton
{
    public static function render(string $id): void
    {
        ?>
        <section class="flex justify-start mb-[48px] min-w-[316px] w-full ml-[-8px] sm:ml-[40px]">
            <button type="button" id="<?php echo $id ?>" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                <div class="w-[24px] h-[24px] flex justify-center items-center">
                    <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                </div>
            </button>
        </section>
       <?php
    }
}
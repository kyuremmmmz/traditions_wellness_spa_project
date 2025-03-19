<?php

namespace Project\App\Views\Php\Components\Texts;

use Project\App\Views\Php\Components\Texts\Text;

class CountDisplayer
{
    public static function render(string $color, string $count, string $content, string $id = '', string $name = ''): void
    {
        ob_start();
        Text::render($id, $name, 'BodyMediumOne text-onBackground dark:text-darkOnBackground leading-none', $count);
        $countHtml = ob_get_clean();

        ob_start();
        Text::render('', '', 'CaptionOne text-onBackground dark:text-darkOnBackground leading-none', $content);
        $textHtml = ob_get_clean();

        echo '<div class="flex items-start gap-[8px]">
                <span class="w-[8px] h-[8px] bg-' . $color . ' rounded-full mt-[3px]"></span>
                <div class="flex flex-col gap-[4px]">
                    ' . $countHtml . '
                    ' . $textHtml . '
                </div>
              </div>';
    }
}
<?php

namespace Project\App\Views\Php\Components\Headers;

use Project\App\Views\Php\Components\Texts\Text;

class DrawerTitle
{
    public static function render(string $title, string $caption): void
    {
        ?>
        <section class="flex flex-col gap-[8px] w-[400px] max-w-full">
            <?php Text::render('', '', 'HeaderTwo leading-none text-onBackground dark:text-darkOnBackground', $title); ?>
            <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo', $caption); ?>
        </section>
        <?php 
    }
}
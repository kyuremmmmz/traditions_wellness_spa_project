<?php

namespace Project\App\Views\Php\Components\Texts;

use Project\App\Views\Php\Components\Texts\Text;

class LastUpdated
{
    public static function getLastUpdated() {
        return "Last updated on " . date("F j, g:i A");
    }

    public static function render(?string $className = null): void
    {
        echo Text::render('', '', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo text-left leading-none', self::getLastUpdated());
    }
}
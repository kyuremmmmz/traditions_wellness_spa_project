<?php

namespace Project\App\Views\Php\Components\Texts;

class Helper
{
    public static function render(string $description): void
    {
        echo '<button type="button" onclick="alert(\'' . htmlspecialchars($description) . '\')" class="flex items-center justify-center w-[16px] h-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo">';
        echo '<svg class="w-[16px] h-[16px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>';
        echo '</button>';
    }
}
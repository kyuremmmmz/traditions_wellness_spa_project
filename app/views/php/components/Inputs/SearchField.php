<?php

namespace Project\App\Views\Php\Components\Inputs;

class SearchField
{
    public static function render(string $placeholder = "Search...", string $onInput = ""): void
    {
        echo <<<HTML
        <div class="relative w-full max-w-[220px]">
            <svg class="absolute left-3 top-2.5 w-5 h-5 text-onBackgroundTwo dark:text-darkOnBackgroundTwo" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10.5 18A7.5 7.5 0 1010.5 3a7.5 7.5 0 000 15z" />
            </svg>
            <input 
                type="text" 
                placeholder="$placeholder" 
                class="w-full pl-10 pr-4 py-2 border border-borderTwo bg-background dark:bg-darkBackground BodyTwo dark:border-darkBorderTwo rounded-lg text-onBackground dark:text-darkOnBackground focus:outline-none focus:ring-2 focus:ring-primary"
                oninput="$onInput"
            />
        </div>
        HTML;
    }
}

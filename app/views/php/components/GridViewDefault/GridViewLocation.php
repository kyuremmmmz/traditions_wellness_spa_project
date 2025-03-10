<?php

namespace Project\App\Views\Php\Components\GridViewDefault;

class GridViewLocation
{
    public static function render(?string $className = null): void
    {
        echo <<<HTML
        <div class="grid grid-cols-3 gap-[24px]">
            <div class="flex flex-wrap justify-center items-center w-[89px] h-[89px] mx-auto select-none gap-2">
                <label class="text-slate-400">
                    <input type="radio" name="location" value="branch" class="h-[1px] opacity-0 overflow-hidden absolute whitespace-nowrap w-[1px] peer">
                    <span class="peer-checked:border-onBackgroundLink peer-checked:border-[2px] peer-checked:text-onBackgroundLink flex flex-col items-center justify-center w-[89px] h-[89px] rounded-lg shadow-lg transition-all duration-200 cursor-pointer relative border-slate-300 border-[1px] bg-inherit hover:shadow-blue-500/10">
                        <span class="transition-all duration-100">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 2.66669H8.00004C6.52728 2.66669 5.33337 3.86059 5.33337 5.33335V26.6667C5.33337 28.1394 6.52728 29.3334 8.00004 29.3334H24C25.4728 29.3334 26.6667 28.1394 26.6667 26.6667V5.33335C26.6667 3.86059 25.4728 2.66669 24 2.66669Z" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 29.3333V24H20V29.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.6666 8H10.68" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.3334 8H21.3467" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 8H16.0133" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 13.3333H16.0133" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 18.6667H16.0133" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.3334 13.3333H21.3467" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.3334 18.6667H21.3467" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.6666 13.3333H10.68" stroke="currentColor"   stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.6666 18.6667H10.68" stroke="currentColor"  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-center transition-all duration-300">Branch</span>
                    </span>
                </label>
            </div>
            <div class="flex flex-wrap justify-center items-center w-[89px] h-[89px] mx-auto select-none gap-2">
                <label class="text-slate-400">
                    <input type="radio" name="location" value="home" class="h-[1px] opacity-0 overflow-hidden absolute whitespace-nowrap w-[1px] peer">
                    <span class="peer-checked:border-onBackgroundLink peer-checked:border-[2px] peer-checked:text-onBackgroundLink flex flex-col items-center justify-center w-[89px] h-[89px] rounded-lg shadow-lg transition-all duration-200 cursor-pointer relative border-slate-300 border-[1px] bg-inherit hover:shadow-blue-500/10">
                        <span class="transition-all duration-100">
                            <svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 11L13 1.66669L25 11V25.6667C25 26.3739 24.719 27.0522 24.219 27.5523C23.7189 28.0524 23.0406 28.3334 22.3333 28.3334H3.66667C2.95942 28.3334 2.28115 28.0524 1.78105 27.5523C1.28095 27.0522 1 26.3739 1 25.6667V11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 28.3333V15H17V28.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-center transition-all duration-300">Home</span>
                    </span>
                </label>
            </div>
        </div>
        HTML;
    }
}
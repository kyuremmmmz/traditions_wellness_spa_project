<?php

namespace Project\App\Views\Php\Components\GridViewDefault;

class GridViewDefaultComponent
{
    public static function render(?string $className = null): void
    {
        echo <<<HTML
        <div class="grid grid-cols-3 gap-[24px] {$className}">
            <!-- Call Item -->
            <div class="flex flex-wrap justify-center items-center w-[89px] h-[89px] mx-auto select-none gap-2">
                <label class="text-slate-400">
                    <input type="radio" name="contact_option" class="h-[1px] opacity-0 overflow-hidden absolute whitespace-nowrap w-[1px] peer">
                    <span class="peer-checked:border-onBackgroundLink peer-checked:border-[2px] peer-checked:text-onBackgroundLink flex flex-col items-center justify-center w-[89px] h-[89px] rounded-lg shadow-lg transition-all duration-200 cursor-pointer relative border-slate-300 border-[1px] bg-inherit hover:shadow-blue-500/10">
                        <span class="transition-all duration-100">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M28.3333 21.56V25.56C28.3349 25.9314 28.2588 26.2989 28.11 26.6392C27.9613 26.9794 27.7431 27.2848 27.4695 27.5358C27.1958 27.7869 26.8728 27.978 26.521 28.097C26.1692 28.2159 25.7965 28.2601 25.4267 28.2267C21.3238 27.7809 17.3827 26.3789 13.92 24.1334C10.6985 22.0862 7.96713 19.3549 5.92001 16.1334C3.66665 12.655 2.26434 8.69469 1.82668 4.57336C1.79336 4.20465 1.83718 3.83304 1.95535 3.48219C2.07351 3.13135 2.26344 2.80895 2.51303 2.53552C2.76263 2.2621 3.06642 2.04364 3.40507 1.89406C3.74372 1.74447 4.1098 1.66704 4.48001 1.66669H8.48001C9.12709 1.66033 9.7544 1.88947 10.245 2.3114C10.7357 2.73334 11.0561 3.31929 11.1467 3.96003C11.3155 5.24012 11.6286 6.497 12.08 7.70669C12.2594 8.18393 12.2982 8.70258 12.1919 9.2012C12.0855 9.69982 11.8385 10.1575 11.48 10.52L9.78668 12.2134C11.6848 15.5514 14.4486 18.3153 17.7867 20.2134L19.48 18.52C19.8425 18.1615 20.3002 17.9145 20.7988 17.8082C21.2975 17.7018 21.8161 17.7406 22.2933 17.92C23.503 18.3714 24.7599 18.6845 26.04 18.8534C26.6877 18.9447 27.2792 19.271 27.7021 19.77C28.1249 20.2691 28.3496 20.9061 28.3333 21.56Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-center transition-all duration-300">Call</span>
                    </span>
                </label>
            </div>

            <!-- Chat Item -->
            <div class="flex flex-wrap justify-center items-center w-[89px] h-[89px] mx-auto select-none gap-2">
                <label class="text-slate-400">
                    <input type="radio" name="contact_option" class="h-[1px] opacity-0 overflow-hidden absolute whitespace-nowrap w-[1px] peer">
                    <span class="peer-checked:border-onBackgroundLink peer-checked:border-[2px] peer-checked:text-onBackgroundLink flex flex-col items-center justify-center w-[89px] h-[89px] rounded-lg shadow-lg transition-all duration-200 cursor-pointer relative border-slate-300 border-[1px] bg-inherit hover:shadow-blue-500/10">
                        <span class="transition-all duration-100">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M25 17C25 17.7072 24.719 18.3855 24.219 18.8856C23.7189 19.3857 23.0406 19.6667 22.3333 19.6667H6.33333L1 25V3.66667C1 2.95942 1.28095 2.28115 1.78105 1.78105C2.28115 1.28095 2.95942 1 3.66667 1H22.3333C23.0406 1 23.7189 1.28095 24.219 1.78105C24.719 2.28115 25 2.95942 25 3.66667V17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-center transition-all duration-300">Chat</span>
                    </span>
                </label>
            </div>

            <!-- Walk In Item -->
            <div class="flex flex-wrap justify-center items-center w-[89px] h-[89px] mx-auto select-none gap-2">
                <label class="text-slate-400">
                    <input type="radio" name="contact_option" class="h-[1px] opacity-0 overflow-hidden absolute whitespace-nowrap w-[1px] peer">
                    <span class="peer-checked:border-onBackgroundLink peer-checked:border-[2px] peer-checked:text-onBackgroundLink flex flex-col items-center justify-center w-[89px] h-[89px] rounded-lg shadow-lg transition-all duration-200 cursor-pointer relative border-slate-300 border-[1px] bg-inherit hover:shadow-blue-500/10">
                        <span class="transition-all duration-100">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 28L6.66667 28C5.95942 28 5.28114 27.719 4.78105 27.219C4.28095 26.7189 4 26.0406 4 25.3333L4 6.66667C4 5.95942 4.28095 5.28115 4.78105 4.78105C5.28115 4.28095 5.95942 4 6.66667 4L12 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.6667 9.33335L12 16L18.6667 22.6667" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16L28 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-center transition-all duration-300">Walk In</span>
                    </span>
                </label>
            </div>
        </div>
        HTML;
    }
}

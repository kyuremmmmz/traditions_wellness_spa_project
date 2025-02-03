<?php

namespace Project\App\Views\Php\Components\Buttons;

class PrimaryButton
{
    public static function render(string $content, string $type, ?string $mt = "", ?string $mr = "", ?string $mb = "", ?string $ml = "", ?string $title = null, ?string $disabled = null, ?string $formnovalidate = null): void
    {
        echo <<<HTML
            <button type="{$type}" class="text-onPrimary dark:text-darkOnPrimary text-BodyMediumTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover rounded-[6px] w-[148px] h-[40px] mt-{$mt} mr-{$mr} mb-{$mb} ml-{$ml}" $disabled $formnovalidate title="{$title}">
                $content
            </button>
        HTML;
    }
}

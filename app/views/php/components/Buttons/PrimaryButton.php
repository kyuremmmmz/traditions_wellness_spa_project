<?php

namespace Project\App\Views\Php\Components\Buttons;

class PrimaryButton
{
    public static function render(string $content, string $type, ?string $mt = "", ?string $mr = "", ?string $mb = "", ?string $ml = "", ?string $title = null, ?string $disabled = null, ?string $formnovalidate = null, ?string $id = null, ?string $onclick = null): void
    {
        echo <<<HTML
            <button type="{$type}" class="text-onPrimary dark:text-darkOnPrimary text-BodyMediumTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover disabled:bg-secondaryVariant dark:disabled:bg-darkSecondaryVariant rounded-[6px] w-[148px] h-[40px] mt-{$mt} mr-{$mr} mb-{$mb} ml-{$ml}" $disabled $formnovalidate title="{$title}" id="$id" onclick="$onclick">
                $content
            </button>
        HTML;
    }
}

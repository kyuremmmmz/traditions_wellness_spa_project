<?php

namespace Project\App\Views\Php\Components\Buttons;

class NewPrimaryButton
{
    public static function render(string $content, string $type, string $id,string $width, ?string $disabled = null): void
    {
        echo <<<HTML
            <button type="{$type}" class="text-onPrimary dark:text-darkOnPrimary transition-all ease-in-out text-BodyMediumTwo bg-primary dark:bg-darkPrimary hover:bg-primaryHover dark:hover:bg-darkPrimaryHover disabled:bg-secondaryVariant dark:disabled:bg-darkSecondaryVariant rounded-[6px] w-[{$width}] h-[40px]" $disabled id="$id">
                $content
            </button>
        HTML;
    }
}
<?php

namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Icons\IconChoice;

class SelectField
{
    public static function render(?array $options = null, string $label, ?string $name = null, ?string $id = null, ?string $defaultValue = null): void
    {
        $nameAttribute = $name ? "name=\"$name\"" : '';
        $idAttribute = $id ? "id=\"$id\"" : '';

        echo <<<HTML
        <div class='relative FieldContainer min-w-[316px] w-full max-w-[400px]'>
            <label for='{$id}' id='{$id}-label' 
            class="transition-all ease-in-out absolute left-[7px] top-[3px] transform -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo
                peer-placeholder-shown:translate-y-[10px] peer-placeholder-shown:MiniOne MiniOne
                peer-focus:-translate-y-1 peer-focus:text-onBackground dark:peer-focus:text-darkOnBackground peer-focus:MiniOne  peer-[&:not(:placeholder-shown)]:-translate-y-1 dark:bg-darkBackground bg-background px-[7px] pointer-events-none origin-top-left">
                {$label}
            </label>
        HTML;
        echo '<div>';
        echo    IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[16px] -rotate-90', '', 'onSurface', 'darkOnSurface');
        echo <<<HTML
                <select $nameAttribute $idAttribute
                    class='peer w-full h-[45px] px-[12px] appearance-none bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] transition-all duration-300'>
        HTML;
                foreach ($options as $value => $optionLabel) {
                $selected = ($value === $defaultValue) ? 'selected' : '';
        echo        "<option value=\"$value\" $selected>$optionLabel</option>";
            }
        echo <<<HTML
                </select>
            </div>
        </div>
HTML;
    }
}
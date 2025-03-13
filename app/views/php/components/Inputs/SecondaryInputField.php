<?php

namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Icons\IconChoice;

class SecondaryInputField
{
    public static function render(string $fieldChoice, string $label, string $placeholder, array $options = [], string $error = '', ?callable $validationCallback = null): void
    {

        echo '<div class="flex gap-[16px] items-center">';
        echo '<div class="flex flex-col gap-[4px] w-full">';
        echo '<p class="CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none max-w-[240px] text-right">'. $label . '</p>';
        if ($error !== '')
        {
            echo '<p class="CaptionOne text-destructive dark:text-destructive leading-none max-w-[240px] text-right">'. $error . '</p>';
        }
        echo '</div>';

        $validationAttribute = $validationCallback ? "oninput='this.value = ($validationCallback)(this.value)'" : '';

        switch ($fieldChoice) {
            case 'textfield':
                echo "<input type='text' class='border border-border dark:border-darkBorder border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[160px] max-w-[240px]' placeholder='$placeholder' $validationAttribute>";
                break;
            case 'numberfield':
                echo "<input type='number' class='appearance-none border border-border dark:border-darkBorder border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[160px] max-w-[240px]' placeholder='$placeholder' style='-moz-appearance: textfield;' $validationAttribute>";
                echo "<style>
                        input[type=number]::-webkit-inner-spin-button, 
                        input[type=number]::-webkit-outer-spin-button { 
                            -webkit-appearance: none; 
                            margin: 0; 
                        }
                      </style>";
                break;
            case 'textareafield':
                echo "<textarea class='border border-border dark:border-darkBorder border-[1px] h-[80px] rounded-[6px] p-[12px] w-full min-w-[160px] max-w-[240px]' placeholder='$placeholder' $validationAttribute></textarea>";
                break;
            case 'emailfield':
                echo "<input type='email' class='border border-border dark:border-darkBorder border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[160px] max-w-[240px]' placeholder='$placeholder' $validationAttribute>";
                break;
            case 'dropdownfield':
                echo "<div class='relative w-full min-w-[200px] max-w-[260px]'>";
                echo IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[16px] -rotate-90', '', 'onSurface', 'darkOnSurface');
                echo "<select class='appearance-none border border-border dark:border-darkBorder border-[1px] h-[40px] rounded-[6px] px-[12px] w-full'>";
                foreach ($options as $option) {
                    echo "<option value='$option'>$option</option>";
                }
                echo "</select></div>";
                break;
            case 'datefield':
                echo "<input type='date' class='border border-border dark:border-darkBorder border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[160px] max-w-[240px]' placeholder='$placeholder' $validationAttribute>";
                break;
            default:
                echo "<input type='text' class='border border-border dark:border-darkBorder border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[160px] max-w-[240px]' placeholder='$placeholder' $validationAttribute>";
        }

        echo '</div>';
    }
}
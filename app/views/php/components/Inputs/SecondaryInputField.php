<?php

namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Icons\IconChoice;

class SecondaryInputField
{
    public static function render(string $fieldChoice, string $label, string $placeholder, array $options = [], string $error = '', ?callable $validationCallback = null, string $id = '', string $duration = '', string $price = '', array $priceOptions = [], bool $isDisabled = false): void
    {
        echo '<div class="flex gap-[16px]">';
        echo '<div class="flex flex-col gap-[4px] w-full justify-center">';
        echo '<p class="BodyTwo text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none max-w-[260px] text-right">'. $label . '</p>';
        if ($error !== '')
        {
            echo '<p class="BodyTwo text-destructive dark:text-destructive leading-none max-w-[260px] text-right">'. $error . '</p>';
        }
        echo '</div>';

        $validationAttribute = $validationCallback ? "oninput='this.value = ($validationCallback)(this.value)'" : '';
        $idAttribute = $id ? "id='$id'" : '';
        $disabledAttribute = $isDisabled ? 'disabled' : '';
        $disabledClass = $isDisabled ? 'opacity-30 cursor-not-allowed' : '';

        switch ($fieldChoice) {
            case 'textfield':
                echo "<input type='text' class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                break;
            case 'numberfield':
                echo "<input type='number' class='BodyTwo appearance-none border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' style='-moz-appearance: textfield;' $validationAttribute $idAttribute $disabledAttribute>";
                echo "<style>
                        input[type=number]::-webkit-inner-spin-button, 
                        input[type=number]::-webkit-outer-spin-button { 
                            -webkit-appearance: none; 
                            margin: 0; 
                        }
                      </style>";
                break;
            case 'textareafield':
                echo "<textarea class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[80px] rounded-[6px] p-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $disabledAttribute></textarea>";
                break;
            case 'emailfield':
                echo "<input type='email' class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $disabledAttribute>";
                break;
            case 'dropdownfield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[16px] -rotate-90', '', 'onSurface', 'darkOnSurface');
                echo "<select class='BodyTwo appearance-none border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full' $disabledAttribute>";
                // Removed placeholder option
                foreach ($options as $option) {
                    echo "<option value='$option' class='text-onBackground dark:text-darkOnBackground'>$option</option>";
                }
                echo "</select></div>";
                break;
            case 'datefield':
                echo "<input type='date' class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $disabledAttribute>";
                break;
            case 'timefield':
                echo "<input type='time' class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                break;
            case 'slotpickerfield':
                echo "<div class='flex gap-[9px] min-w-[260px] max-w-[260px] $disabledClass'>";
                foreach ($options as $option) {
                    echo "<div class='relative'>";
                    echo "<input type='checkbox' name='{$id}[]' value='$option' class='peer hidden' id='{$id}_$option' $disabledAttribute>";
                    echo "<label for='{$id}_$option' class='BodyTwo flex items-center justify-center w-[40px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface'>$option</label>";
                    echo "</div>";
                }
                echo "</div>";
                break;
            case 'checkboxwithpricefield':
                echo "<div class='flex flex-col gap-[12px] min-w-[260px] max-w-[260px] $disabledClass'>";
                foreach ($options as $option) {
                    echo "<div class='flex items-center gap-[12px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px]'>";
                    echo "<input type='checkbox' name='{$id}[]' value='{$option['label']}' class='w-[16px] h-[16px] accent-primary dark:accent-darkPrimary rounded-[4px]' $disabledAttribute>";
                    echo "<div class='flex flex-col gap-[8px]'>";
                    echo "<p class='BodyTwo text-onBackground leading-none dark:text-darkOnBackground'>{$option['label']}</p>";
                    echo "<div class='flex gap-[8px]'>";
                    echo "<p class='CaptionOne text-onBackgroundTwo leading-none dark:text-darkOnBackgroundTwo'>+ {$option['duration']}</p>";
                    echo "<p class='CaptionOne text-primary leading-none  dark:text-darkPrimary'>₱{$option['price']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
                break;
            case 'dropdownwithpricefield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[16px] -rotate-90', '', 'onSurface', 'darkOnSurface');
                echo "<select class='BodyTwo appearance-none border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full' $idAttribute $disabledAttribute>";
                // Removed placeholder option
                foreach ($priceOptions as $option) {
                    $quantity = $option['quantity'];
                    $price = $option['price'];
                    echo "<option value='$quantity' class='text-onBackground dark:text-darkOnBackground'>$quantity - <p class='text-primary dark:text-darkPrimary'>₱$price</p></option>";
                }
                echo "</select></div>";
                break;
            case 'searchfield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo "<svg class='absolute left-3 top-2.5 w-5 h-5 text-gray-400' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-4.35-4.35M10.5 18A7.5 7.5 0 1010.5 3a7.5 7.5 0 000 15z' />
                      </svg>";
                echo "<input type='search' class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] pl-10 px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                echo "</div>";
                break;
            default:
                echo "<input type='text' class='BodyTwo border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px]' placeholder='$placeholder' $validationAttribute>";
        }

        echo '</div>';
    }
}
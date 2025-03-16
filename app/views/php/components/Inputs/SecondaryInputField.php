<?php

namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Icons\IconChoice;

class SecondaryInputField
{
    public static function render(string $fieldChoice, string $label, string $placeholder, array $options = [], string $error = '', ?callable $validationCallback = null, string $id = '', string $duration = '', string $price = '', array $priceOptions = [], bool $isDisabled = false, string $name = '', int $limit = 0): void
    {
        echo '<div class="flex gap-[16px]">';
        echo '<div class="flex flex-col gap-[4px] w-full justify-center">';
        echo '<p class="BodyTwo text-onBackground dark:text-darkOnBackground text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none max-w-[260px] text-right">' . $label . '</p>';
        if ($error !== '') {
            echo '<p class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground text-destructive dark:text-destructive leading-none max-w-[260px] text-right">' . $error . '</p>';
        }
        echo '</div>';

        $validationAttribute = $validationCallback ? "oninput='this.value = ($validationCallback)(this.value)'" : '';
        $idAttribute = $id ? "id='$id'" : '';
        $disabledAttribute = $isDisabled ? 'disabled' : '';
        $disabledClass = $isDisabled ? 'opacity-30 cursor-not-allowed' : '';

        switch ($fieldChoice) {
            case 'searchselectfield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo "<svg class='absolute left-3 top-2.5 w-5 h-5 text-gray-400' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-4.35-4.35M10.5 18A7.5 7.5 0 1010.5 3a7.5 7.5 0 000 15z' />
                      </svg>";
                echo "<input type='search' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] pl-10 px-[12px] w-full' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                echo "<div id='{$id}_selected' class='flex flex-col gap-2 mt-2'></div>";

                // Store the script to be output at the end of the page
                $GLOBALS['footer_scripts'][] = "<script>
                    (function() {
                        const input = document.querySelector('input[name=\"$name\"]');
                        const selectedContainer = document.getElementById('{$id}_selected');
                        const limit = $limit;
                        let selectedItems = [];
                
                        input.addEventListener('input', function() {
                            // Implement search logic here
                        });
                    
                        function addItem(item) {
                            if (selectedItems.length < limit) {
                                selectedItems.push(item);
                                const itemElement = document.createElement('div');
                                itemElement.className = 'flex justify-between items-center border p-2 rounded';
                                itemElement.innerHTML = '<span>' + item + '</span><button type=\"button\" class=\"remove-btn\">×</button>';
                                selectedContainer.appendChild(itemElement);
                        
                                itemElement.querySelector('.remove-btn').addEventListener('click', function() {
                                    selectedItems = selectedItems.filter(function(i) { return i !== item; });
                                    selectedContainer.removeChild(itemElement);
                                    input.disabled = selectedItems.length >= limit;
                                });
                        
                                input.disabled = selectedItems.length >= limit;
                            }
                        }
                    
                        // Example: Add item on Enter key press
                        input.addEventListener('keydown', function(e) {
                            if (e.key === 'Enter' && input.value.trim() !== '') {
                                e.preventDefault();
                                addItem(input.value.trim());
                                input.value = '';
                            }
                        });
                    })();
                </script>";

                echo "</div>";
                break;
            case 'textfield':
                echo "<input type='text' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                break;
            case 'numberfield':
                echo "<input type='number' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground appearance-none border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' style='-moz-appearance: textfield;' $validationAttribute $idAttribute $disabledAttribute>";
                echo "<style>
                        input[type=number]::-webkit-inner-spin-button, 
                        input[type=number]::-webkit-outer-spin-button { 
                            -webkit-appearance: none; 
                            margin: 0; 
                        }
                      </style>";
                break;
            case 'textareafield':
                echo "<textarea name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[80px] rounded-[6px] p-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $disabledAttribute></textarea>";
                break;
            case 'emailfield':
                echo "<input type='email' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $disabledAttribute>";
                break;
            case 'dropdownfield':
                echo '<select name="' . $name . '" ' . $idAttribute . ' class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground w-full min-w-[260px] max-w-[260px] h-[40px] border border-border dark:border-darkBorder rounded-[6px] px-[16px] appearance-none cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface ' . $disabledClass . '" ' . $disabledAttribute . '>';
                foreach ($options as $option) {
                    if (is_array($option)) {
                        echo '<option value="' . htmlspecialchars($option['value']) . '">' . htmlspecialchars($option['label']) . '</option>';
                    } else {
                        echo '<option value="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</option>';
                    }
                }
                echo '</select>';
                break;
            case 'dropdownServicefield':
                echo '<select name="' . $name . '" ' . $idAttribute . ' class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground w-full min-w-[260px] max-w-[260px] h-[40px] border border-border dark:border-darkBorder rounded-[6px] px-[16px] appearance-none cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface ' . $disabledClass . '" ' . $disabledAttribute . '>';

                echo '</select>';
                break;
            case 'datefield':
                echo "<input type='date' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $disabledAttribute>";
                break;
            case 'timefield':
                echo "<input type='time' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                break;
            case 'slotpickerfield':
                echo "<div class='flex gap-[9px] min-w-[260px] max-w-[260px] $disabledClass'>";
                foreach ($options as $option) {
                    echo "<div class='relative'>";
                    echo "<input type='checkbox' name='{$name}[]' value='$option' class='hidden peer' id='{$id}_$option' $disabledAttribute>";
                    echo "<label for='{$id}_$option' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center justify-center w-[40px] h-[40px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface'>$option</label>";
                    echo "</div>";
                }
                echo "</div>";
                break;
            case 'checkboxwithpricefield':
                echo "<div class='flex flex-col gap-[12px] min-w-[260px] max-w-[260px] $disabledClass'>";
                foreach ($options as $option) {
                    echo "<div class='flex items-center gap-[12px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px]'>";
                    echo "<input type='checkbox' name='{$name}[]' value='{$option['label']}' class='w-[16px] h-[16px] bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo accent-primary dark:accent-darkPrimary rounded-[4px]' $disabledAttribute>";
                    echo "<div class='flex flex-col gap-[8px]'>";
                    echo "<p class='leading-none BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground'>{$option['label']}</p>";
                    echo "<div class='flex gap-[8px]'>";
                    echo "<p class='leading-none CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo'>+ {$option['duration']}</p>";
                    echo "<p class='leading-none CaptionOne text-primary dark:text-darkPrimary'>₱{$option['price']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
                break;
            case 'dropdownwithpricefield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo IconChoice::render('chevronRightSmall', '[12px]', '[12px] absolute right-[16px] top-[16px] -rotate-90', '', 'onSurface', 'darkOnSurface');
                echo "<select name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground appearance-none border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full' $idAttribute $disabledAttribute>";
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
                echo "<input type='search' id='$id' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] pl-10 px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass'  placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                echo "</div>";
                break;
            default:
                echo "<input type='text' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px]' placeholder='$placeholder' $validationAttribute>";
        }

        echo '</div>';
    }
}

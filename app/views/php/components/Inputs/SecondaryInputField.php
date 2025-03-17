<?php

namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Icons\IconChoice;

class SecondaryInputField
{
    public static function render(string $fieldChoice, string $label, string $placeholder, array $options = [], string $error = '', ?callable $validationCallback = null, string $id = '', string $duration = '', string $price = '', array $priceOptions = [], bool $isDisabled = false, string $name = '', int $limit = 0): void
    {
        echo '<div class="flex gap-[16px]">';
        echo '<div class="flex flex-col gap-[4px] w-full justify-center">';
        echo '<p class="BodyTwo text-onBackground dark:text-darkOnBackground text-onBackgroundTwo dark:text-darkOnBackgroundTwo leading-none max-w-[300px] text-right">'. $label . '</p>';
        if ($error !== '')
        {
            echo '<p class="BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground text-destructive dark:text-destructive leading-none max-w-[260px] text-right">'. $error . '</p>';
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
                echo "<div id='{$id}_selected' class='mt-2 flex flex-col gap-2'></div>";
                
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

            case 'photofield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo "<input type='file' name='$name' accept='image/*' class='hidden' id='{$id}_input' $disabledAttribute>";
                echo "<div id='{$id}_fileList' class='flex flex-col gap-[8px]'>";
                echo "<div id='{$id}_placeholder' class='BodyTwo flex items-center gap-[8px] text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface' onclick='document.getElementById(\"{$id}_input\").click()'>";
                echo "<span class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo'>$placeholder</span>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                
                $GLOBALS['footer_scripts'][] = "<script>
                    document.getElementById('{$id}_input').addEventListener('change', function(e) {
                        const fileList = document.getElementById('{$id}_fileList');
                        const placeholder = document.getElementById('{$id}_placeholder');
                        const file = e.target.files[0];
                        
                        if (file) {
                            // Create file item element
                            const fileItem = document.createElement('div');
                            fileItem.className = 'flex items-center justify-between bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo rounded-[6px] px-[12px] h-[40px]';
                            fileItem.innerHTML = `
                                <span class='BodyTwo text-onBackground dark:text-darkOnBackground truncate'>\${file.name}</span>
                                <button type='button' class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:text-destructive dark:hover:text-destructive ml-[8px]' onclick='clearPhotoInput(\"{$id}_input\")'>×</button>
                            `;
                            
                            // Replace placeholder with file item
                            placeholder.classList.add('hidden');
                            fileList.appendChild(fileItem);
                        }
                    });

                    function clearPhotoInput(inputId) {
                        const input = document.getElementById(inputId);
                        const fileList = document.getElementById(inputId.replace('input', 'fileList'));
                        const placeholder = document.getElementById(inputId.replace('input', 'placeholder'));
                        
                        // Remove all file items except placeholder
                        Array.from(fileList.children).forEach(child => {
                            if (child !== placeholder) {
                                child.remove();
                            }
                        });
                        
                        input.value = '';
                        placeholder.classList.remove('hidden');
                    }
                </script>";
                break;
            case 'multiphotofield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo "<input type='file' name='{$name}[]' accept='image/*' class='hidden' id='slideshow_{$id}_input' $disabledAttribute>";
                echo "<div id='slideshow_{$id}_fileList' class='flex flex-col gap-[8px]'>";
                echo "<button type='button' id='slideshow_{$id}_addButton' onclick='document.getElementById(\"slideshow_{$id}_input\").click()' class='BodyTwo flex items-center justify-between bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full cursor-pointer hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface'>";
                echo "<span class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo'>$placeholder</span>";
                echo "</button>";
                echo "</div>";
                echo "</div>";
                
                $GLOBALS['footer_scripts'][] = "<script>
                    (function() {
                        const input = document.getElementById('slideshow_{$id}_input');
                        const fileList = document.getElementById('slideshow_{$id}_fileList');
                        const addButton = document.getElementById('slideshow_{$id}_addButton');
                        const maxFiles = 5;
                        const minFiles = 2;
                        let fileCount = 0;
                        let files = [];

                        input.addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            
                            if (file && fileCount < maxFiles) {
                                fileCount++;
                                files.push(file);
                                
                                // Create hidden input for the file
                                const hiddenInput = document.createElement('input');
                                hiddenInput.type = 'file';
                                hiddenInput.name = 'slideshow_{$name}[]';
                                hiddenInput.className = 'hidden';
                                hiddenInput.id = 'slideshow_{$id}_file_' + fileCount;
                                
                                // Create DataTransfer object to set the file
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(file);
                                hiddenInput.files = dataTransfer.files;
                                
                                // Create file item element
                                const fileItem = document.createElement('div');
                                fileItem.className = 'flex items-center justify-between bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo rounded-[6px] px-[12px] h-[40px]';
                                fileItem.innerHTML = `
                                    <span class='BodyTwo text-onBackground dark:text-darkOnBackground truncate'>\${file.name}</span>
                                    <button type='button' class='text-onBackgroundTwo dark:text-darkOnBackgroundTwo hover:text-destructive dark:hover:text-destructive ml-[8px]'>×</button>
                                `;
                                
                                // Add remove functionality
                                const removeButton = fileItem.querySelector('button');
                                removeButton.onclick = function() {
                                    fileList.removeChild(fileItem);
                                    document.getElementById('slideshow_{$id}_file_' + fileCount).remove();
                                    files = files.filter(f => f !== file);
                                    fileCount--;
                                    updateAddButton();
                                };
                                
                                // Add elements to DOM
                                fileList.insertBefore(hiddenInput, addButton);
                                fileList.insertBefore(fileItem, addButton);
                                updateAddButton();
                                
                                // Clear input for next selection
                                input.value = '';
                            }
                        });

                        function updateAddButton() {
                            addButton.style.display = fileCount >= maxFiles ? 'none' : 'flex';
                            const remainingRequired = Math.max(0, minFiles - fileCount);
                            const buttonText = remainingRequired > 0 
                                ? `$placeholder (\${remainingRequired} more required)`
                                : fileCount >= maxFiles 
                                    ? ''
                                    : '$placeholder';
                            addButton.querySelector('span').textContent = buttonText;
                        }

                        updateAddButton();
                    })();
                </script>";
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
                    echo "<input type='checkbox' name='{$name}[]' value='$option' class='peer hidden' id='{$id}_$option' $disabledAttribute>";
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
                    echo "<p class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground text-onBackground leading-none dark:text-darkOnBackground'>{$option['label']}</p>";
                    echo "<div class='flex gap-[8px]'>";
                    echo "<p class='CaptionOne text-onBackgroundTwo leading-none dark:text-darkOnBackgroundTwo'>+ {$option['duration']}</p>";
                    echo "<p class='CaptionOne text-primary leading-none dark:text-darkPrimary'>₱{$option['price']}</p>";
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
                echo "<input type='search' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] pl-10 px-[12px] w-full min-w-[260px] max-w-[260px] $disabledClass' placeholder='$placeholder' $validationAttribute $idAttribute $disabledAttribute>";
                echo "</div>";
                break;
            
            case 'choicesselectionfield':
                echo "<div class='relative w-full min-w-[260px] max-w-[260px] $disabledClass'>";
                echo "<div class='border border-borderTwo dark:border-darkBorderTwo rounded-[6px] p-[12px]'>";
                echo "<div class='flex flex-col gap-[8px]'>";
                foreach ($options as $option) {
                    echo "<div class='relative'>";
                    echo "<input type='checkbox' name='{$name}[]' value='$option' class='peer hidden' id='{$id}_$option' $disabledAttribute>";
                    echo "<label for='{$id}_$option' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground flex items-center px-[12px] h-[36px] border border-borderTwo dark:border-darkBorderTwo rounded-[6px] cursor-pointer peer-checked:border-primary peer-checked:dark:border-darkPrimary peer-checked:text-primary peer-checked:dark:text-darkPrimary hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface w-full'>$option</label>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
                break;
            
            default:
                echo "<input type='text' name='$name' class='BodyTwo text-onBackground dark:text-darkOnBackground bg-background dark:bg-darkBackground border border-borderTwo dark:border-darkBorderTwo border-[1px] h-[40px] rounded-[6px] px-[12px] w-full min-w-[260px] max-w-[260px]' placeholder='$placeholder' $validationAttribute>";
        
            }   

        echo '</div>';
    }
}
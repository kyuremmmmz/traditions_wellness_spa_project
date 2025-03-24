<?php
namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Icons\IconChoice;
class GlobalInputField { // TOD0: BASTA HINDI PA ITO TAPOS!

    public static function render(string $name, string $label, string $type, string $id, ?string $error = null, ?string $extras = null, ?string $extraClasses = null):void {

        $errorClass = $error ? "border-destructive dark:border-darkDestructive focus:border-destructive dark:focus:border-darkDestructive" : "border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-borderHighlight";

        // Add validation classes
        $validationClass = "";
        if ($type === 'number') {
            $validationClass = "validate-price-number";
        } elseif (strpos($name, 'newShortDescription') !== false) {
            $validationClass = "validate-short-description";
        } elseif ($name === 'serviceNameInputField') {
            $validationClass = "validate-service-name";
        } elseif ($name === 'firstNameInputField' || $name === 'lastNameInputField') {
            $validationClass = "validate-name";
        } elseif ($type === 'email') {
            $validationClass = "validate-email";
        } elseif ($name === 'phoneNumberInputField') {
            $validationClass = "validate-phone-number";
        }
        echo '<script src="http://localhost/TraditionsWellnessSpa/Project/app/views/js/hooks/password-toggle.js"></script>';
        echo <<<HTML
    <div class='relative FieldContainer min-w-[316px] w-full max-w-[400px]'>
        <input type='{$type}' id='{$id}' name='{$name}' placeholder=" " oninput='handleInput(this)' $extras
            class='peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground {$extraClasses} {$errorClass} {$validationClass} border-[2px] border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-borderHighlight focus:ring-borderHighlight dark:focus:ring-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-[6px] autofill:bg-background dark:autofill:bg-background [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none' />
        <label for='{$id}' id='{$id}-label' 
            class="transition-all ease-in-out absolute BodyOne left-[7px] top-0 transform -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo
            peer-placeholder-shown:translate-y-[10px] peer-placeholder-shown:BodyOne
            peer-focus:-translate-y-1 peer-focus:text-onBackground dark:peer-focus:text-darkOnBackground peer-focus:MiniOne
            peer-[&:not(:placeholder-shown)]:MiniOne peer-[&:not(:placeholder-shown)]:-translate-y-1 dark:bg-darkBackground bg-background px-[7px] pointer-events-none origin-top-left">
            {$label}
        </label>
HTML;

        if ($type === "password") {
            $eye = "eyeClose";
            echo <<<HTML
        <button type="button" id="password_toggle_{$id}" onclick="togglePasswordVisibility('{$id}')" 
            class="absolute right-3 top-[22px] -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo focus:outline-none transition-colors duration-300">
            <div id="password_icon_{$id}">
HTML;
            IconChoice::render($eye, '[20px]', '[20px]', '', 'onBackgroundTwo', 'darkOnBackgroundTwo');
            echo '</div></button>';
        }

        // Error Message
        if ($error) {
            echo "<div class='mt-[8px] mb-[8px] w-[316px] h-[14px] mx-[5px] CaptionMediumTwo text-destructive dark:text-darkDestructive leading-none'>{$error}</div>";
        } elseif ($id === "new_password_field") {
            echo '';
        } else {
            echo "<p class='MiniOne my-[8px] w-[316px] h-[14px] mx-[5px] text-destructive dark:text-darkDestructive'> </p>";
        }
echo <<<HTML
        </div>

        <script>
            (function() {
                function handleInput(input) {
                    const label = document.getElementById(input.id + '-label');
                    const errorMessage = input.parentElement.querySelector('.text-destructive'); // Selects the error message div

                    // Handle when the user starts typing again, reset the border and error message
                    if (input.value.trim() !== '') {
                        label.classList.add('MiniOne', '-translate-y-1', 'text-onBackground', 'dark:text-darkOnBackground');
                        label.classList.remove('BodyOne', 'text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo', 'peer-placeholder-shown:translate-[8px]', 'peer-placeholder-shown:text-onBackgroundTwo', 'dark:peer-placeholder-shown:text-darkOnBackgroundTwo');

                        // Remove the error border when the user starts typing
                        input.classList.remove('border-destructive', 'dark:border-darkDestructive', 'focus:border-destructive', 'dark:focus:border-darkDestructive');
                        input.classList.add('border-borderTwo', 'dark:border-darkBorderTwo', 'focus:border-borderHighlight', 'dark:focus:border-borderHighlight'); // Reset to normal border

                        // Clear the error message when user starts typing again
                        if (errorMessage) {
                            errorMessage.innerHTML = "&nbsp;"; // Correctly inserts a non-breaking space
                        }
                        
                    } else {
                        // Reset the label back to its placeholder state
                        label.classList.remove('MiniOne', '-translate-y-1', 'text-onBackground', 'dark:text-darkOnBackground');
                        label.classList.add('BodyOne', 'text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo', 'peer-placeholder-shown:translate-[8px]', 'peer-placeholder-shown:text-onBackgroundTwo', 'dark:peer-placeholder-shown:text-darkOnBackgroundTwo');

                        // If the input is empty, keep the error class
                        if (!input.value && '{$error}') {
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        }
                    }

                    // Add validation for email
                    if (input.classList.contains('validate-email')) {
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        const value = input.value;
                        const errorMessage = input.parentElement.querySelector('.text-destructive');

                        if (!emailPattern.test(value)) {
                            errorMessage.textContent = 'Please enter a valid email address';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        } else {
                            input.classList.remove('border-destructive', 'dark:border-darkDestructive');
                            errorMessage.innerHTML = "&nbsp;";
                        }
                    }

                    // Add validation for short descriptions
                    if (input.classList.contains('validate-short-description')) {
                        const maxLength = 45;
                        const value = input.value;
                        const errorMessage = input.parentElement.querySelector('.text-destructive');
                        
                        if (value.length >= maxLength) {
                            // Prevent further input if at max length
                            if (value.length > maxLength) {
                                input.value = value.slice(0, maxLength);
                            }
                            errorMessage.textContent = 'Maximum ' + maxLength + ' characters allowed';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        } else {
                            input.classList.remove('border-destructive', 'dark:border-darkDestructive');
                            errorMessage.innerHTML = "&nbsp;";
                        }
                    }

                    // Add validation for service name
                    if (input.classList.contains('validate-service-name')) {
                        const maxLength = 25;
                        const value = input.value;
                        const errorMessage = input.parentElement.querySelector('.text-destructive');
                        
                        if (value.length > maxLength) {
                            input.value = value.slice(0, maxLength);
                            errorMessage.textContent = 'Maximum ' + maxLength + ' characters allowed';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        } else {
                            input.classList.remove('border-destructive', 'dark:border-darkDestructive');
                            errorMessage.innerHTML = "&nbsp;";
                        }
                    }

                    // Add number validation
                    if (input.classList.contains('validate-price-number')) {
                        const value = input.value;
                        const errorMessage = input.parentElement.querySelector('.text-destructive');
                        
                        if (value === '' || isNaN(value)) {
                            errorMessage.textContent = 'Please enter a valid number';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                            return;
                        }

                        const numValue = parseFloat(value);
                        if (numValue > 5000) {
                            errorMessage.textContent = 'Price cannot exceed ₱5,000';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                            input.value = 5000;
                        } else if (numValue < 0) {
                            errorMessage.textContent = 'Price cannot be negative';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                            input.value = 0;
                        }
                    }

                    // Add validation for names
                    if (input.classList.contains('validate-name')) {
                        const namePattern = /^[a-zA-Z\s'-]+$/;
                        const maxLength = 25;
                        const value = input.value;
                        const errorMessage = input.parentElement.querySelector('.text-destructive');

                        if (!namePattern.test(value)) {
                            errorMessage.textContent = 'Please enter a valid name';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        } else if (value.length > maxLength) {
                            input.value = value.slice(0, maxLength);
                            errorMessage.textContent = 'Maximum ' + maxLength + ' characters allowed';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        } else {
                            input.classList.remove('border-destructive', 'dark:border-darkDestructive');
                            errorMessage.innerHTML = "&nbsp;";
                        }
                    }
                    // Add validation for phone numbers
                    if (input.classList.contains('validate-phone-number')) {
                        const phonePattern = /^(?:\+63|0)\d{10}$/;
                        const value = input.value;
                        const errorMessage = input.parentElement.querySelector('.text-destructive');

                        if (!phonePattern.test(value)) {
                            errorMessage.textContent = 'Please enter a valid Philippine phone number';
                            input.classList.add('border-destructive', 'dark:border-darkDestructive');
                        } else {
                            input.classList.remove('border-destructive', 'dark:border-darkDestructive');
                            errorMessage.innerHTML = "&nbsp;";
                        }
                    }
                }

                window.handleInput = handleInput;
            })();
        </script>
        HTML;
    }
}
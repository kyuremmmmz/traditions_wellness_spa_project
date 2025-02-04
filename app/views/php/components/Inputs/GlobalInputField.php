<?php
namespace Project\App\Views\Php\Components\Inputs;

use Project\App\Views\Php\Components\Icons\IconChoice;
class GlobalInputField { // TOD0: BASTA HINDI PA ITO TAPOS!


    public static function render(string $name, string $label, string $type, string $id, ?string $error = null):void {
        switch ($id) {
            case "email_field":
                $Attributes = "title='Please enter a valid email address.'";
                break;
            case "password_field": // ITO LANG DAPAT!
                $Attributes = "title='Please enter your password.'";
                break;
            case "phone_number_field":
                $Attributes = "pattern='^09[0-9]{9}$' title='Please enter your phone number.'";
                break;
            case "number_field":
                $Attributes = "pattern='[0-9]{6}' title='Please enter your verification code.'";
                break;
            case "username_field_login":
                $Attributes = "title='Please enter your username'";
                break;
            case "username_field":
                $Attributes = "";
                break;
        }

        $errorClass = $error ? "border-destructive dark:border-darkDestructive focus:border-destructive dark:focus:border-darkDestructive" : "border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-darkBorderHighlight";



echo <<<HTML
        <script src="/js/password-toggle.js"></script>
        <div class='relative FieldContainer'>
            <input type='{$type}' id='{$id}' name='{$name}' placeholder=" " oninput='handleInput(this)'; 
                class='peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground {$errorClass} border-[2px] border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-darkBorderHighlight focus:ring-borderHighlight dark:focus:ring-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-md autofill:bg-background dark:autofill:bg-background' />
            <label for='{$id}' id='{$id}-label' 
                class='absolute BodyOne left-[7px] top-0 transform -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo
                peer-placeholder-shown:translate-y-[10px] peer-focus:-translate-y-1 peer-focus:text-onBackground dark:peer-focus:text-darkOnBackground peer-focus:MiniOne
                dark:bg-darkBackground bg-background px-[7px] pointer-events-none origin-top-left'>
                {$label}
            </label>
HTML;       

            if ($type === "password") {
                $eye = "eyeClose";
                echo '<button type="button" id="password_toggle" onclick="togglePasswordVisibility()" class="absolute right-3 top-[22px] -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo focus:outline-none transition-colors duration-300"><div id="password_icon">';
                IconChoice::render($eye, '[24px]', '[24px]', '', 'onBackgroundTwo', 'darkOnBackgroundTwo' );
                echo '</div></button>';
            }



            // Error Message
            if ($error) {
                echo "<div class='mt-[8px] mb-[8px] w-[316px] h-[8px] mx-[5px] CaptionMediumTwo text-destructive dark:text-darkDestructive leading-none'>{$error}</div>";
            } elseif ($id === "new_password_field") {
                echo '';
            } else {
                echo "<p class='MiniOne my-[8px] w-[316px] h-[8px] mx-[5px] text-destructive dark:text-darkDestructive'>&nbsp</p>";
            }
 
echo <<<HTML
        </div>

        <script>
            function handleInput(input) {
                const label = document.getElementById(input.id + '-label');
                const errorMessage = input.parentElement.querySelector('.text-destructive'); // Selects the error message div

                // Handle when the user starts typing again, reset the border and error message
                if (input.value.trim() !== '') {
                    label.classList.add('MiniOne', '-translate-y-1', 'text-onBackground', 'dark:text-darkOnBackground');
                    label.classList.remove('BodyOne', 'text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo', 'peer-placeholder-shown:translate-[8px]', 'peer-placeholder-shown:text-onBackgroundTwo', 'dark:peer-placeholder-shown:text-darkOnBackgroundTwo');

                    // Remove the error border when the user starts typing
                    input.classList.remove('border-destructive', 'dark:border-darkDestructive', 'focus:border-destructive', 'dark:focus:border-darkDestructive');
                    input.classList.add('border-borderTwo', 'dark:border-darkBorderTwo', 'focus:border-borderHighlight', 'dark:focus:border-darkBorderHighlight'); // Reset to normal border

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
            }
        </script>
        HTML;
    }
}
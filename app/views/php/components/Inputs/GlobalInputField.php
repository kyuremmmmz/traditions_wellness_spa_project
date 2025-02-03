<?php
namespace Project\App\Views\Php\Components\Inputs;

use Respect\Validation\Rules\Yes;

class GlobalInputField {

    private string $Attributes = "";

    public static function render(string $name, string $label, string $type, string $id, ?string $error = null):void {
        switch ($id) {
            case "email_field":
                $Attributes = "title='Please enter a valid email address.'";
                break;
            case "password_field_login":
                $Attributes = "minlength='8' title='Please enter your password.'";
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

echo <<<HTML
        <div class='FieldContainer relative'>
            <input type='{$type}' id='{$id}' name='{$name}' placeholder=" " oninput='handleInput(this)' {$Attributes} 
                class='peer w-full h-[45px] px-[12px] bg-background dark:bg-darkBackground border-[2px] border-borderTwo dark:border-darkBorderTwo focus:border-borderHighlight dark:focus:border-darkBorderHighlight focus:ring-borderHighlight dark:focus:ring-borderHighlight text-onBackground dark:text-darkOnBackground outline-none rounded-md autofill:bg-background dark:autofill:bg-background' />
            <label for='{$id}' id='{$id}-label' 
                class='absolute BodyOne left-[7px] top-0 transform -translate-y-1/2 text-onBackgroundTwo dark:text-darkOnBackgroundTwo
                peer-placeholder-shown:translate-y-[10px] peer-focus:-translate-y-1 peer-focus:text-onBackground dark:peer-focus:text-darkOnBackground peer-focus:MiniOne
                dark:bg-darkBackground bg-background px-[7px] pointer-events-none origin-top-left'>
                {$label}
            </label>
HTML;       

            // Extras
            if ($type == "password") {

echo <<<HTML
                <!--
                <button onclick='togglePassword("{$name}")' 
                    class='absolute text-gray-500 transition-colors duration-300 -translate-y-1/2 right-3 top-1/2 hover:text-blue-500 focus:outline-none'>
                    <i id='{->name}-icon' class='transition-all duration-300 fas fa-eye'></i>
                </button>-->
HTML;
            
            }

            // Error Message
            if ($error) {
                 echo "<div class='mt-[8px] mb-[8px] w-[316px] mx-[5px] CaptionMediumTwo text-destructive dark:text-darkDestructive'>{$error}</div>";
            } else {
                echo "<p class='MiniOne my-[8px] w-[316px] mx-[5px] text-destructive dark:text-darkDestructive'>&nbsp</p>";
            }
 
echo <<<HTML
        </div>

        <script>
            function handleInput(input) {
                const label = document.getElementById(input.id + '-label');
                const errorMessage = input.parentElement.querySelector('.text-destructive'); // Selects the error message div

                if (input.value.trim() !== '') {
                    label.classList.add('MiniOne', '-translate-y-1', 'text-onBackground', 'dark:text-darkOnBackground');
                    label.classList.remove('BodyOne', 'text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo', 'peer-placeholder-shown:translate-[8px]', 'peer-placeholder-shown:text-onBackgroundTwo', 'dark:peer-placeholder-shown:text-darkOnBackgroundTwo');

                    // Clear error message when user starts typing again
                    if (errorMessage) {
                        errorMessage.innerHTML = "&nbsp;"; // Correctly inserts a non-breaking space

                    }
                } else {
                    label.classList.remove('MiniOne', '-translate-y-1', 'text-onBackground', 'dark:text-darkOnBackground');
                    label.classList.add('BodyOne', 'text-onBackgroundTwo', 'dark:text-darkOnBackgroundTwo', 'peer-placeholder-shown:translate-[8px]', 'peer-placeholder-shown:text-onBackgroundTwo', 'dark:peer-placeholder-shown:text-darkOnBackgroundTwo');
                }
            }
        </script>
        HTML;
    }
}
?>
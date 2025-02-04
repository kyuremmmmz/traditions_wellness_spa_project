<?php
namespace Project\App\Views\Php\Pages\ForgotPassword;

use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\InputField;


class Page
{
    public static function forgotpassword()
    {
        session_start();
        $emailError = $_SESSION['forgot_password_errors']['email'] ?? '';
        unset($_SESSION['forgot_password_errors']);

        echo <<<HTML
        <div class="flex items-center justify-center min-h-screen">
            <div class="flex flex-col items-center w-full max-w-md px-4">
                <!-- Return Button -->
                <div class="self-start mb-8">
HTML;
        
        $returnButton = new ReturnButton(
            "Return to Login", 
            "button",  
            16, 
            true,
            "window.location.href = '/login'"
        );
        echo $returnButton->render();

        echo <<<HTML
                </div>

                <div class="w-[312px] h-[15.788px] shrink-0 flex flex-col justify-center mb-8">
                    <h2 class="font-inter text-[22px] font-semibold leading-[150%] tracking-[-0.484px] text-center">
                        Forgot Password?
                    </h2>
                </div>

                <div class="flex flex-col items-center justify-center w-[312px] h-[30.588px] flex-shrink-0 text-[#71717A] mb-8">
                    <p class="font-inter text-base font-normal leading-[21px] tracking-tight text-center">
                       Please enter your email address below. We’ll send you a link to reset your password.
                   </p>
                </div>

                <form method="POST" action="/forgot" class="w-full max-w-xs space-y-6">
HTML;
        
        $emailField =  GlobalInputField::render('email', 'Please enter your email', 'email', 'email');
        echo '<div class="w-full">' . $emailField . '</div>';

        echo <<<HTML
                    <button type="submit" class="w-full py-3 text-white transition-colors bg-blue-600 rounded-md hover:bg-blue-700">
                        Continue
                    </button>
                </form>
            </div>
        </div>
        HTML;
    }
}

Page::forgotpassword();
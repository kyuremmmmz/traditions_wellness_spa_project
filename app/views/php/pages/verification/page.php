<?php
namespace Project\App\Views\Php\Pages\Verification;

use Project\App\Views\Php\Components\Inputs\InputField;
use Project\App\Views\Php\Components\Button\ReturnButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;

class Page
{
    public static function verification()
    {
        session_start();
        $emailError = $_SESSION['forgot_password_errors']['verification'] ?? '';
        unset($_SESSION['forgot_password_errors']);
        echo <<<HTML
        <div class="flex items-center justify-center min-h-screen">
            <div class="flex flex-col items-center w-full max-w-md px-4">
                <!-- Return Button -->
                <div class="self-start mb-8">
        HTML;
        
        

        echo <<<HTML
                </div>

                <div class="w-[312px] h-[15.788px] shrink-0 flex flex-col justify-center mb-8">
                    <h2 class="font-inter text-[22px] font-semibold leading-[150%] tracking-[-0.484px] text-center">
                        Verification Code
                    </h2>
                </div>

                <div class="flex flex-col items-center justify-center w-[312px] h-[30.588px] flex-shrink-0 text-[#71717A] mb-8">
                    <p class="font-inter text-base font-normal leading-[21px] tracking-tight text-center">
                        Please enter the verification code we sent to your email.
                    </p>
                </div>

                <form method="POST" action="/forgotPass" class="w-full max-w-xs space-y-6">
HTML;
        
        $emailField = GlobalInputField::render('remember_token', 'Token', 'text', 'remember_token');
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

Page::verification();
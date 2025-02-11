<?php
namespace Project\App\Views\Php\Pages\ForgotPassword;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;


class Page
{
    public static function forgotpassword()
    {
        // TODO: EMAIL ERROR MESSAGE!!! dapat sabihin niya email not registered, invalid email format.
        session_start();
        $emailError = $_SESSION['forgot_password_errors']['email'] ?? '';
        unset($_SESSION['forgot_password_errors']);

        // start of page
                    Header::render('Small');
        echo        '<main class="OneColumnContainer mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';
                        ReturnButton::render("[316px]", "/login");
        echo            '<form method="POST" action="/forgot">';
                            Text::render("", "", "HeaderTwo text-left mt-[40px] mb-[8px] text-onBackground dark:text-darkOnBackground", "Forgot Password");
                            Text::render("", "", "BodyTwo w-[316px] mt-[16x] text-left mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo", "Please enter your email address below. We'll send you a link to reset your password.");
                            GlobalInputField::render('email', 'Email','email', 'email_field_forgot_password', $emailError);
        echo                '<div class="w-[326px] flex justify-center">';
                            PrimaryButton::render('Continue', 'submit', '[200px]',  '', '', '', 'Continue', '', 'novalidate');
        echo                '</div>
                        </form>
                    </main>';
    }
}

Page::forgotpassword();
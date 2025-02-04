<?php
namespace Project\App\Views\Php\Pages\ForgotPassword;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\HeaderTwo;


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
        echo        '<main class="OneColumnContainer mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';;
                        ReturnButton::render("[316px]", "/login");
        echo            '<form method="POST" action="/forgot">';
                            HeaderTwo::render('Forgot Password', 'onBackground', 'darkOnBackground', '', '[316px]', '[40px]', '',  '[8px]');
                            BodyTwo::render("Please enter your email address below. We'll send you a link to reset your password.", 'onBackgroundTwo','darkOnBackgroundTwo','','[316px]','','','[18px]');
                            GlobalInputField::render('email', 'Email','email', 'email_field_forgot_password', $emailError);
        echo                '<div class="w-[316px] flex justify-center">';
                            PrimaryButton::render('Continue', 'submit', '[200px]',  '', '', '', 'Continue', '', 'novalidate');
        echo                '</div>
                        </form>
                    </main>';
    }
}

Page::forgotpassword();
<?php
namespace Project\App\Views\Php\Pages\Verification;

use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\HeaderTwo;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Texts\BodyTwo;

class Page
{
    public static function verification()
    {
        session_start();
        $verificationError = $_SESSION['forgot_password_errors']['verification'] ?? '';
        //unset($_SESSION['forgot_password_errors']);


        // start of page
        Header::render('Small');
        echo        '<main class="OneColumnContainer min-h-screen mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';
                        ReturnButton::render("[316px]", "/forgotpassword");
                        HeaderTwo::render('Verification Code', 'onBackground', 'darkOnBackground', '', '[316px]', '[40px]', '', '[8px]');
                        BodyTwo::render('Please enter the verification code we sent to your email.', 'onBackgroundTwo', 'darkOnBackgroundTwo', '', '[316px]', '', '','[10px]');
                        GlobalInputField::render('verification', 'Verification Code', 'text', 'verification_field_forgot_password', $verificationError);
                        echo '<div class="w-[316px] flex justify-center">';
                            PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");
                        echo '</div>';
                        
        echo        '</main>';

    }
}

Page::verification();
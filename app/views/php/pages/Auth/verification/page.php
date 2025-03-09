<?php

namespace Project\App\Views\Php\Pages\Verification;

use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\HeaderTwo;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function verification()
    {
        // TODO: error kineme
        $verificationError = $_SESSION['forgot_password_errors']['verification'] ?? '';
        //unset($_SESSION['forgot_password_errors']);


        // start of page
?>
        <form action="/forgotPass" method="POST">
            <?php
            Header::render('Small');
            echo        '<main class="OneColumnContainer mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';
            ReturnButton::render("[316px]", "/forgotpassword");
            Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Verification Code");
            Text::render('','', 'BodyTwo w-[316px] mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo', 'Please enter the verification code we sent to your email');
            GlobalInputField::render('verification', 'Verification Code', 'text', 'verification_field_forgot_password', $verificationError);
            echo '<div class="w-[326px] flex justify-center">';
            PrimaryButton::render("Continue", "submit", "[200px]", "", "", "", "Continue");
            echo '</div>';
            ?>
        </form>

<?php

    }
}

Page::verification();

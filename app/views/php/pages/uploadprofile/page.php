<?php
namespace Project\App\Views\Php\Pages\uploadprofile;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Buttons\ImgUploadButton;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\HeaderTwo;

class Page {
    public static function uploadprofile() {
        session_start();
        unset($_SESSION['forgot_password_errors']);

        // Start of page
        Header::render('Small');

        echo '<main class="OneColumnContainer h-screen mt-[24px] sm:mt-[24px]>';
        
        ReturnButton::render("[316px]", "/login");

        echo '<form method="POST" action="/forgot" class="flex flex-col items-center space-y-4">';

            HeaderTwo::render('Continue Registration', 'onBackground', 'darkOnBackground', '', '[316px]', '[40px]', '', '[8px]');
            BodyTwo::render("Please upload a profile picture.", 'onBackgroundTwo', 'darkOnBackgroundTwo', '', '[316px]', '', '', '[10px]');

            echo '<div class="flex justify-center w-full mt-4">';
                ImgUploadButton::render();
            echo '</div>';

            echo '<div class="w-[316px] flex justify-center">'; 
                PrimaryButton::render('Continue', 'submit', '[200px]', '', '', '', 'Continue', '', 'novalidate');
            echo '</div>';

        echo '</form>';
        echo '</main>';
    }
}

Page::uploadprofile();

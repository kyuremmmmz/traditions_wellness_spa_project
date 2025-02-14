<?php
namespace Project\App\Views\Php\Pages\uploadprofile;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Buttons\ImgUploadButton;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\HeaderTwo;
use Project\App\Views\Php\Components\Texts\Text;


class Page {
    public static function uploadprofile() {
        session_start();
        unset($_SESSION['forgot_password_errors']);

        //TODO: update profile. disabled hanggat di pa naauppload ung pic.

        // Start of page
        Header::render('Small');

        $disabled = 'disabled';

        echo    '<main class="OneColumnContainer mt-[24px] sm:mt-[24px]">';
        echo        '<form method="POST" action="/uploadProfile" enctype="multipart/form-data" class="flex flex-col items-center">';

                        // HeaderTwo::render('Continue Registration', 'onBackground', 'darkOnBackground', '', '[326px]', '[64px]', '', '[8px]');
        echo            Text::render("", "", "HeaderTwo text-left w-[326px] mt-[64px] mb-[8px] text-onBackground dark:text-darkOnBackground", 'Continue Registration');

                        // BodyTwo::render('Please upload a profile picture.', 'onBackgroundTwo','darkOnBackgroundTwo','','[326px]','','','');
        echo            Text::render("", "", "BodyTwo text-left w-[326px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo", 'Please upload a profile picture.');

        echo        '<div class="flex justify-center w-full mt-4">';
                        ImgUploadButton::render();
        echo        '</div>';
        echo        '<div class="w-[326px] flex justify-center">'; 
                        PrimaryButton::render('Continue', 'submit', '[205px]', '', '', '', 'Continue','novalidate');
        echo        '</div>';
        echo        '</form>';
        echo    '</main>';
    }
}

Page::uploadprofile();

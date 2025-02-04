<?php

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Buttons\ReturnButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\CaptionOne;
use Project\App\Views\Php\Components\Texts\HeaderTwo;

class Page{
    public static function page(){


        $passwordError = "";
        $eightCharacters = "onBackgroundTwo";
        $firstName = 'user';

        // start of page
        Header::render('Small');
        echo        '<main class="OneColumnContainer min-h-screen mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';
                        ReturnButton::render("[316px]", "/forgotpassword");
        echo            '<form method="POST" action="/forgot">';
                            HeaderTwo::render('Hello, ' . $firstName .'', 'onBackground', 'darkOnBackground', '', '[316px]', '[40px]', '',  '[8px]');
                            BodyTwo::render("Please enter your new password below.", 'onBackgroundTwo','darkOnBackgroundTwo','','[316px]','','','[12px]');
                            GlobalInputField::render("password", "Password", "password", "new_password_field", $passwordError);
        echo                '<div>';
                                CaptionOne::render('Your password must contain at least:','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[12px]');
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharacters,);
                                    CaptionOne::render('Eight characters','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharacters,);
                                    CaptionOne::render('One special character (e.g., @, #, $, %).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharacters,);
                                    CaptionOne::render('One upperrcase letter  (A-Z).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharacters,);
                                    CaptionOne::render('One lowercase letter (a-z).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharacters,);
                                    CaptionOne::render('One number (0-9).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                '</div>';
        echo                '<div class="w-[316px] flex justify-center">';
                            PrimaryButton::render('Continue', 'submit', '[200px]',  '', '', '', 'Continue', '', 'novalidate');
        echo                '</div>
                        </form>
                    </main>';
    }
}

Page::page();
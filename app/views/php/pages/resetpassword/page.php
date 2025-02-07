<?php

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\CaptionOne;
use Project\App\Views\Php\Components\Texts\HeaderTwo;

class Page{
    public static function page(){

        // TODO: kung nameet ung ano, dapat magbago ung onBackgroundTwo sa success color("success" na tlga ung name ng color).. 
        // KUNG NAGING SUCCESSFULL YUNG VERIFICATION CODE, DAPAT MABAGO DIN first name!!!!!!!!! <---------
        // HINDI MAGAACTIVATE UNG BUTTON HANGGAT NAIPASA LAHAT NG REQUIREMENTS

        $passwordError = "";

        $eightCharactersCircle = "onBackgroundTwo";

        $specialCharacterCircle = "onBackgroundTwo";

        $uppercaseLetterCircle = "onBackgroundTwo";

        $lowercaseLetterCircle = "onBackgroundTwo";

        $numberCircle = "onBackgroundTwo";

        $firstName = 'user';

        $disabled = 'disabled'; // STRING LANG IBIBIGAY KAY BUTTON, kung wala itong laman, hindi na magiging disabled ung button

        // start of page
        Header::render('Small');
        echo        '<main class="OneColumnContainer mt-[24px] sm:mt-[24px] bg-background dark:bg-darkBackground">';
        echo            '<form method="POST" action="/forgot" novalidate>';
                            HeaderTwo::render('Hello, ' . $firstName .'', 'onBackground', 'darkOnBackground', '', '[316px]', '[64px]', '',  '[8px]');
                            BodyTwo::render("Please enter your new password below.", 'onBackgroundTwo','darkOnBackgroundTwo','','[316px]','','','[18px]');
                            GlobalInputField::render("password", "Password", "password", "password_field", $passwordError);
        echo                '<div class="w-[284px] px-[14px] relative -top-[10px]">';
                                CaptionOne::render('Your password must contain at least:','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[12px]');
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharactersCircle,);
                                    CaptionOne::render('Eight characters','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]', '', '', '', 'eightCharacters');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$specialCharacterCircle,);
                                    CaptionOne::render('One special character (e.g., @, #, $, %).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]' , '', '', '', 'specialCharacters');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$uppercaseLetterCircle,);
                                    CaptionOne::render('One upperrcase letter  (A-Z).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$lowercaseLetterCircle,);
                                    CaptionOne::render('One lowercase letter (a-z).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$numberCircle,);
                                    CaptionOne::render('One number (0-9).','onBackgroundTwo', 'darkonBackgroundTwo',  '','[284px]', '[2px]');
        echo                    '</div>';
        echo                '</div>';
        echo                '<div class="w-[326px] flex justify-center">';
                            PrimaryButton::render('Continue', 'submit', '[99px]',  '', '', '', 'Continue', "' . $disabled .'", 'novalidate');
        echo                '</div>
                        </form>
                    </main>';
    }
}

Page::page();
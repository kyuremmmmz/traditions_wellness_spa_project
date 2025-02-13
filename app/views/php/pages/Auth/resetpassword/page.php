<?php

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\BodyTwo;
use Project\App\Views\Php\Components\Texts\CaptionOne;
use Project\App\Views\Php\Components\Texts\HeaderTwo;
use Project\App\Views\Php\Components\Texts\Text;

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
        echo            '<form method="POST" action="/resetPassword" novalidate>';
                            Text::render("", "", "HeaderTwo text-left mt-[40px] mb-[8px] text-onBackground dark:text-darkOnBackground", "Hello, $firstName"); 
                            Text::render("", "", "BodyTwo w-[316px] mt-[16x] text-left mb-[16px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo", "Please enter your new password below.");
                            GlobalInputField::render("password", "Password", "password", "password_field", $passwordError);
        echo                '<div class="w-[284px] px-[14px] relative -top-[10px]">';
                                Text::render('', "", "CaptionOne w-[284px] mt-[12px] text-onBackgroundTwo text-darkOnBackgroundTwo", "Your password must contain at least:");
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharactersCircle,);
                                    Text::render('eightCharacters', "", "CaptionOne w-[284px] mt-[2px] text-onBackgroundTwo text-darkOnBackgroundTwo", "Eight characters");
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$specialCharacterCircle,);
                                    Text::render('specialCharacters', "", "CaptionOne w-[284px] mt-[2px] text-onBackgroundTwo text-darkOnBackgroundTwo", "One special character (e.g., @, #, $, %).");
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$uppercaseLetterCircle,);
                                    Text::render('upperCaseCharacters', "", "CaptionOne w-[284px] mt-[2px] text-onBackgroundTwo text-darkOnBackgroundTwo", "One upperrcase letter  (A-Z).");
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$lowercaseLetterCircle,);
                                    Text::render('lowerCharacters', "", "CaptionOne w-[284px] mt-[2px] text-onBackgroundTwo text-darkOnBackgroundTwo", "One lowercase letter (a-z).");
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$numberCircle);
                                    Text::render('numberCharacters', "", "CaptionOne w-[284px] mt-[2px] text-onBackgroundTwo text-darkOnBackgroundTwo", "One number (0-9).");
        echo                    '</div>';
        echo                '</div>';
        echo                '<div class="w-[326px] flex justify-center">';
                            PrimaryButton::render('Continue', 'submit', '[99px]',  '', '', '', 'Continue', "' . $disabled .'",'novalidate', 'buttonDisabled');
        echo                '</div>
                        </form>
                    </main>';
    }
}

Page::page();
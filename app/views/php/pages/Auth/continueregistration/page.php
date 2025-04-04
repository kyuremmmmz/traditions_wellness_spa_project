<?php

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;


class Page{
    public static function page(){

        $usernameError = "";
        $passwordError = "";

        $usernameCharactersCircle = "onBackgroundTwo";
        $usernameLettersCircle = "onBackgroundTwo";
        $usernameSpecialCircle = "onBackgroundTwo";

        $eightCharactersCircle = "onBackgroundTwo";
        $specialCharacterCircle = "onBackgroundTwo";
        $uppercaseLetterCircle = "onBackgroundTwo";
        $lowercaseLetterCircle = "onBackgroundTwo";
        $numberCircle = "onBackgroundTwo";

        $disabled = 'disabled';

        // start of page
        Header::render('Small');
        echo        '<main class="OneColumnContainer mt-[24px] sm:mt-[24px]">';
                        WorkingBanner::render(); // Banner Logic
        echo            '<form method="POST" action="/continueRegistrationFunction">';
                            Text::render('','','HeaderTwo text-left text-onBackground dark:text-darkOnBackground w-[316px] mt-[40px] mb-[8px]','Continue Registration');
                            Text::render('','','BodyTwo text-left text-onBackground dark:text-darkOnBackground w-[316px] mb-[18px] ',"Please enter a new username and password below.");
                            GlobalInputField::render("username", "Username", "text", "username_field_login", $usernameError);
                            GlobalInputField::render("password", "Password", "password", "password_field", $passwordError);
        echo                '<div class="w-[284px] px-[14px] relative -top-[10px]">';
                                Text::render('','', 'CaptionOne text-onBackground dark:text-darkOnBackground w-[284px] mb-[3px] mt-[12px]','Your username must contain at least:');
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$usernameCharactersCircle,);
                                    Text::render('usernameEightCharacter','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','Between 8 and 20 characters long.');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$usernameLettersCircle,);
                                    Text::render('userOnlyLettersAndNumbers','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','Only letters, numbers, and underscores.');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$usernameSpecialCircle,);
                                    Text::render('noOtherSpecialCharacters','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','No other special characters.');
        echo                    '</div>';
                                Text::render('','', 'CaptionOne text-onBackground dark:text-darkOnBackground w-[284px] mb-[2px] mt-[12px]','Your password must contain at least:');
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$eightCharactersCircle,);
                                    Text::render('eightCharacters','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','Eight characters.');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$specialCharacterCircle,);
                                    Text::render('specialCharacter','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','One special character (e.g., @, #, $, %).');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$uppercaseLetterCircle,);
                                    Text::render('upperCaseCharacters','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','One upperrcase letter  (A-Z).');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$lowercaseLetterCircle,);
                                    Text::render('lowerCharacters','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','One lowercase letter (a-z).');
        echo                    '</div>';
        echo                    '<div class="flex items-center gap-[7px]">';
                                    IconChoice::render('miniCircle','[8px]','[8px]',$numberCircle,);
                                    Text::render('numberCharacters','', 'CaptionOne text-onBackgroundTwo dark:text-darkOnBackgroundTwo w-[284px] mb-[2px]','One number (0-9).');
        echo                    '</div>';
        echo                '</div>';
        echo                '<div class="w-[326px] flex justify-center">';
                            PrimaryButton::render('Continue', 'submit', '[50px]',  '', '', '', 'Continue', "' . $disabled . '", 'novalidate', 'buttonDisabled');
        echo                '</div>
                        </form>
                    </main>';
    }
}

Page::page();
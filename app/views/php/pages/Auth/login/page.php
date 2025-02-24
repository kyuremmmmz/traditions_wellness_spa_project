<?php

namespace Project\App\Views\Php\Pages\Login;

use Project\App\Views\Php\Components\Assets\SubmarkLogo;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Footer;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\RememberMe;
use Project\App\Views\Php\Components\Texts\GlobalLink;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;

class Page
{
    public static function login()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // TODO: BANNER LOGICs
        // Banner Logic: Needs the following logic
        // 1. Logged Out
        // 2. Server Error
        $usernameError = $_SESSION['login_errors']['username'] ?? '';
        $passwordError = $_SESSION['login_errors']['password'] ?? '';


        unset($_SESSION['login_errors']);
        
        // Start of page
        echo    '<main class="OneColumnContainer mt-[80px] sm:mt-[100px] bg-background dark:bg-darkBackground">';
                        WorkingBanner::render(); // Banner Logic
                        SubmarkLogo::render("[201.37px]", "[88px]", "full", "");
<<<<<<< HEAD:app/views/php/pages/login/page.php
                        Text::render("","", "HeaderTwo text-left text-onBackground dark:text-darkOnBackground mt-[40px] mb-[8px]", "Verification Code");
=======
                        Text::render("", "", "HeaderTwo text-center mt-[40px] mb-[56px] text-onBackground dark:text-darkOnBackground", "Login your account");
>>>>>>> 95efdd6d5ca6a1ce9bdd11f2fb25376928f48fb3:app/views/php/pages/Auth/login/page.php
        echo            '<form method="POST" action="/login" class="FormContainer">';
                                GlobalInputField::render("username", "Username", "text", "username_field_login", $usernameError);
                                echo '<div class="relative">';
                                echo '<div class="relative w-full">';
                                GlobalInputField::render("password", "Password", "password", "password_field", $passwordError);
        echo                    '</div>';

        echo                    '<div class="flex justify-between w-[326px] h-[24px] items-center">';
                                        RememberMe::render();
                                        GlobalLink::render("/forgotpassword", "Forgot Password?");
        echo                    '</div>';

        echo                    '<div class="w-[326px] flex justify-center">';
                                        PrimaryButton::render("Login", "submit", "[56px]", "", "", "", "Login");
        echo                    '</div>';

        echo            '</form>
                </main>';

                Footer::render();
    }  
}

Page::login();

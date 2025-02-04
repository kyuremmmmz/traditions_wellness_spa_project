<?php

namespace Project\App\Views\Php\Pages\Login;

use Project\App\Views\Php\Components\Assets\SubmarkLogo;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Footer;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\RememberMe;
use Project\App\Views\Php\Components\Texts\GlobalLink;
use Project\App\Views\Php\Components\Banners\RegularBanner;
use Project\App\Views\Php\Components\Texts\HeaderTwo;


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
        // 3. Unavailable Service
        // 4. Too Many Attempts
        $emailError = $_SESSION['login_errors']['email'] ?? '';
        $passwordError = $_SESSION['login_errors']['password'] ?? '';

        $tooManyAttempts = isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5;

        if ($tooManyAttempts) {
            http_response_code(429);
                        RegularBanner::render("Account Error", "Too many attempts. Please wait 5 minutes before trying again", "alertBig", "destructive", "darkDestructive");};

        // 5. Deactivated account
        // 6. Account locked

        unset($_SESSION['login_errors']);
        
        // Start of page
        echo    '<main class="OneColumnContainer mt-[80px] sm:mt-[100px] bg-background dark:bg-darkBackground">';
                        SubmarkLogo::render("[201.37px]", "[88px]", "full", "");
                        HeaderTwo::render("Login to your account", "onBackground", "darkOnBackground", "center", "[312px]", "[40px]","" ,"[56px]");

        echo            '<form method="POST" action="/login" class="FormContainer">';
                                GlobalInputField::render("username", "Username", "text", "username_field_login", $emailError);
                                echo '<div class="relative">';
                                echo '<div class="relative w-full">';
                                GlobalInputField::render("password", "Password", "password", "password_field", $passwordError);
        echo                    '</div>';

        echo                    '<div class="flex justify-between w-[326px] h-[24px] items-center">';
                                        RememberMe::render();
                                        GlobalLink::render("/forgotpassword", "Forgot Password?");
        echo                    '</div>';

        echo                    '<div class="w-[316px] flex justify-center">';
                                        PrimaryButton::render("Login", "submit", "[56px]", "", "", "", "Login");
        echo                    '</div>';

        echo            '</form>
                </main>';

                Footer::render();
    }  
}

Page::login();

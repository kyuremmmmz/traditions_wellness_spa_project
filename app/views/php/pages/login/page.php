<?php
namespace Project\App\Views\Php\Pages\Login;

use Project\App\Views\Php\Components\Assets\Logo;
use Project\App\Views\Php\Components\Banner\Small_Banner;
use Project\App\Views\Php\Components\Inputs\InputField;
use Project\App\Views\Php\Components\Inputs\PasswordField;
use Project\App\Views\Php\Components\RememberMe;
use Project\App\Views\Php\Components\ForgotPasswordLink;
use Project\App\Views\Php\Components\Text\Body_1;
use Project\App\Views\Php\Components\Text\Body_2;
use Project\App\Views\Php\Components\Text\Body_Medium_1;
use Project\App\Views\Php\Components\Text\Body_Medium_2;
use Project\App\Views\Php\Components\Text\Caption_1;
use Project\App\Views\Php\Components\Text\Caption_2;
use Project\App\Views\Php\Components\Text\Caption_Medium_1;
use Project\App\Views\Php\Components\Text\Header_1;
use Project\App\Views\Php\Components\Text\Header_2;
use Project\App\Views\Php\Components\Text\Mini_1;
use Project\App\Views\Php\Components\Text\Mini_2;
use Project\App\Views\Php\Components\Text\Subheader_1;
use Project\App\Views\Php\Components\Text\Subheader_2;
class Page
{

   public static function login()
   {
    
       $emailError = $_SESSION['login_errors']['email'] ?? ''; 
       
       echo <<<HTML
        <div class="w-full max-w-md mx-auto">
            <!--   Centered Logo -->pbj,,
            
            <div class="flex justify-center mb-8">
        HTML;
        Header_1::render("Header 1", "primary");
        Subheader_1 ::render("Subheader 1", "on.background");
        Body_Medium_1::render("BodyMedium 1", "on.background");
        Body_1::render("Body 1", "on.background");
        Caption_Medium_1::render("Caption Medium 1",  "on.background");
        Mini_1::render("Mini 1",   "on.background");
        Header_2::render("Header 2", "on.background");
        Subheader_2::render("Subheader 2", "on.background");
        Body_Medium_2::render("Body Medium 2", "on.background");
        Body_2::render("Body 2", "on.background");
        Mini_2::render("Mini 2", "on.background");
        Caption_1::render("Caption 1", "on.background");
        Caption_2::render("Caption 2", "on.background");
        Small_Banner::render("Logged Out","Your account has been successfully logged out");
        Logo::render();
            echo <<<HTML
        </div>
        
        <!-- Login Form -->
        <form method="POST" action="/login" class="flex flex-col items-center w-full space-y-6">
            <div class="w-full max-w-xs space-y-6">
        HTML;
            
                $emailField = new InputField("username", "Username", "username", $emailError);
                echo '<div class="w-full">' . $emailField->render() . '</div>';

                $passwordField = new PasswordField("password", "Password");
                echo '<div class="w-full">' . $passwordField->render() . '</div>';

                echo '<div class="flex items-center justify-between w-full px-2">';
                RememberMe::render();
                $forgotPasswordLink = new ForgotPasswordLink(); 
                $forgotPasswordLink->render();
                echo '</div>';
                
                echo <<<HTML
                <button type="submit" class="w-full px-6 py-3 text-white transition-colors duration-200 bg-blue-600 rounded-lg    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Log In
                </button>
            </div>
        </form>
    </div>
HTML;
   }
}

Page::login();
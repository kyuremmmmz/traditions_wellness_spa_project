<?php
namespace Project\App\Views\Php\Pages\Login;

use Project\App\Views\Php\Components\Assets\Logo;
use Project\App\Views\Php\Components\Inputs\InputField;
use Project\App\Views\Php\Components\Inputs\PasswordField;
use Project\App\Views\Php\Components\RememberMe;
use Project\App\Views\Php\Components\ForgotPasswordLink;

class Page
{
   public static function login()
   {
    
       $emailError = $_SESSION['login_errors']['email'] ?? ''; 
       
       echo <<<HTML
        <div class="w-full max-w-md mx-auto">
            <!-- Centered Logo -->
            <div class="flex justify-center mb-8">
        HTML;
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
                <button type="submit" class="w-full px-6 py-3 text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Log In
                </button>
            </div>
        </form>
    </div>
HTML;
   }
}

Page::login();
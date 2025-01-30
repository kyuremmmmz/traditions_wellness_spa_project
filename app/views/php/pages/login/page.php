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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $emailError = $_SESSION['login_errors']['email'] ?? '';
        if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
            http_response_code(429);
            echo "<div id='error-message' class='py-20 pb-5 text-center text-red-500'>
            Too many attempts. Please try again after 5 minutes.
        </div>";

            echo "<script>
            setTimeout(function() {
                document.getElementById('error-message').style.display = 'none';
            }, 5000);
        </script>";
            echo
<<<HTML
        <div class="flex flex-col justify-center w-full max-w-md mx-auto itemscol-center">
            <div class="flex justify-center mb-8">
HTML;
            Logo::render();
            echo
<<<HTML
        </div>
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
                <button type="submit" class="w-full px-6 py-3 text-white transition-colors duration-200 bg-blue-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Log In
                </button>
            </div>
        </form>
    </div>
HTML;

        }else{
            echo
            <<<HTML
        <div class="flex flex-col items-center justify-center w-full max-w-md px-5 py-20 mx-auto ">
            <div class="flex justify-center mb-8">
HTML;
            Logo::render();
            echo
            <<<HTML
        </div>
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
            echo
            <<<HTML
                <button type="submit" class="w-full px-6 py-3 text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Log In
                </button>
            </div>
        </form>
    </div>
HTML;
        }
        
    }
}

Page::login();

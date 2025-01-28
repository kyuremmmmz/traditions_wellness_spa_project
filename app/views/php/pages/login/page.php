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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> 
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gray-50">

    <div class="w-full max-w-md mx-auto">
        <!-- Centered Logo -->
        <div class="flex justify-center mb-8">
HTML;
            Logo::render();
            echo <<<HTML
        </div>
        
        <!-- Login Form -->
        <form method="POST" action="/login" class="flex flex-col items-center space-y-6 w-full" novalidate>
            <div class="w-full max-w-xs space-y-6">
HTML;
             
                $emailField = new InputField("email", "Email", "email", $emailError);
                echo '<div class="w-full">' . $emailField->render() . '</div>';

                $passwordField = new PasswordField("password", "Password");
                echo '<div class="w-full">' . $passwordField->render() . '</div>';

                echo '<div class="w-full flex justify-between items-center px-2">';
                RememberMe::render();
                $forgotPasswordLink = new ForgotPasswordLink(); 
                $forgotPasswordLink->render();
                echo '</div>';
                
                echo <<<HTML
                <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                    Log In
                </button>
            </div>
        </form>
    </div>
</body>
</html>
HTML;
   }
}

Page::login();
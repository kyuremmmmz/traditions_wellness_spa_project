<?php
namespace Project\App\Views\Php\Pages\Login;

// Import component classes
use Project\App\Views\Php\Components\Assets\Logo;
use Project\App\Views\Php\Components\Inputs\InputField;
use Project\App\Views\Php\Components\Inputs\PasswordField;
use Project\App\Views\Php\Components\RememberMe;
use Project\App\Views\Php\Components\ForgotPasswordLink;

class Page
{
   public static function login()
   {
     
       $emailError = ""; 
       
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
    <body class="flex items-center justify-center min-h-screen bg-gray-900">

        <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
            <!-- Centered Logo -->
            <div class="flex justify-center mb-6">
HTML;
             Logo::render();
             echo <<<HTML
             </div>
             
        <!-- Login Form -->
        <form method="POST" action="/login" class="space-y-6">
HTML;
        $emailField = new InputField("email", "Email", "email", $emailError);
        echo $emailField->render();

        $passwordField = new PasswordField("password", "Password");
        echo $passwordField->render();

        
        RememberMe::render();
        $forgotPasswordLink = new ForgotPasswordLink(); 
        $forgotPasswordLink->render();
         
        echo <<<HTML
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Login In
            </button>
        </form>
    </div>
</body>
</html>
HTML;
   }
}

Page::login();

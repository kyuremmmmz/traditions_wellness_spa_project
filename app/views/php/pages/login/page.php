<?php

namespace Project\App\Views\Php\Pages\Login;

class Page
{
    public static function login()
    {
        echo <<<HTML
        <div class="w-full flex flex-col items-center justify-center min-h-screen bg-secondary text-white">
            <h1 class="text-2xl font-bold mb-4">Login Page</h1>
            <p>Login functionality will go here.</p>
        </div>
        HTML;
    }
}

Page::login();

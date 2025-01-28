<?php

namespace Project\App\Views\Php\Pages\Login;

class Page
{
    public static function login()
    {
        echo <<<HTML
        <div class="flex flex-col items-center justify-center w-full min-h-screen">
            <h1 class="mb-4 text-2xl font-bold">Login Page</h1>
            <p>Login functionality will go here.</p>
        </div>
        HTML;
    }
}

Page::login();

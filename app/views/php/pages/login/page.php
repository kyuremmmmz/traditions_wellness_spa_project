<?php

namespace Project\App\Views\Php\Pages\Login;

use Project\App\Views\Php\Components\Fields\PasswordField;

class Page
{
    public static function login()
    {
    ?>
        <div class="flex flex-col items-center justify-center w-full min-h-screen">
            <?php PasswordField::render() ?>
        </div>
    <?php
    }
}

Page::login();

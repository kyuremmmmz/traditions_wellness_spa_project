<?php

namespace Project\App\Views\Php\Components\Validations;

use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;

class Reset
{
    public static function render(?string $className = null): void
    {
        ?>
        <div>
            <form action="/resetPassword" method="POST">
                <?php GlobalInputField::render('newPassword', 'New password', 'password', 'password' );
                PrimaryButton::render('Submit', 'submit');
                ?>
            </form>
        </div>
        <?php
        ;
    }
}


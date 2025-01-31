<?php

namespace Project\App\Views\Php\Components\Forms;

use Project\App\Views\Php\Components\Button\GlobalButton;
use Project\App\Views\Php\Components\Fields\GlobalFields;

class Reset
{
    public static function render(?string $className = null): void
    {
        ?>
        <div>
            <form action="/resetPassword" method="POST">
                <?php GlobalFields::render('bg-white', 'text');
                      GlobalButton::render('Submit')
                ?>
            </form>
        </div>
        <?php
        ;
    }
}


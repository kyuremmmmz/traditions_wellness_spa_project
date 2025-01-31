<?php

namespace Project\App\Views\Php\Components;

class Verification
{
    public static function render(?string $className = null): void
    {
        echo <<<HTML
        <div>
            <form action="" method="post"></form>
        </div>
        HTML;
    }
}
<?php

namespace Project\App\Views\Php\Components\Fields;

class GlobalFields
{
    public static function render(?string $className = null, ?string $type = null, ?string $name= null): void
    {
        echo <<<HTML
        <div>
            <input class="$className" name="$name" type="$type">
        </div>
        HTML;
    }
}
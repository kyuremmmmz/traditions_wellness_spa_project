<?php
namespace Project\App\Views\Php\Components\Button;

class GlobalButton
{
    public static function render(
        string $content)
        : void {
            echo <<<HTML
            <button class="px-16 py-3 text-white font-semibold rounded bg-primary">
                $content
        </button>
        HTML;
    } 
}

?>

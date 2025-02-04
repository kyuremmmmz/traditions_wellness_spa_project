<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class ReturnButton
{
    public static function render(string $width = "", string $goToPage): void
    {
        echo        '<button class="w-{$width} h-[14px]" onclick="goToPage()">';
                        IconChoice::render("leftArrow", "[14px]", "[14px]", '', 'onBackground', 'darkOnBackground', 'background', 'darkBackground', 'secondary', 'darkSecondary');
        echo        '</button>
                    <script>
                        function goToPage() {
                            window.location.href = "' . $goToPage . '";
                        }
                    </script>';
    }
}
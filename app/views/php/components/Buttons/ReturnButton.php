<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class ReturnButton {
    public static function render(string $width = "", string $goToPage = ""): void
    {
        echo    '<button class="w-' . htmlspecialchars($width, ENT_QUOTES, 'UTF-8') . ' h-[14px]" onclick="goToPage()">';

                    IconChoice::render("leftArrow", "[14px]", "[14px]", '', 'onBackground', 'darkOnBackground', 'background', 'darkBackground', 'secondary', 'darkSecondary');

        echo    '</button>
                <script>
                    function goToPage() {
                        window.location.href = "' . htmlspecialchars($goToPage, ENT_QUOTES, 'UTF-8') . '";
                    }
                </script>';
    }
}
?>

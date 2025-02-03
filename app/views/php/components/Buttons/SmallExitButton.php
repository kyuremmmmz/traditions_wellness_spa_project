<?php

namespace Project\App\Views\Php\Components\Buttons;

use Project\App\Views\Php\Components\Icons\IconChoice;

class SmallExitButton
{
    private string $secondaryVariant = "'secondaryVariant'";
    public static function render(string $idOfTargetWindow): void {
        echo '<button onclick="document.getElementById(\'' . $idOfTargetWindow . '\').remove()" class="w-[12px] h-[12px]">';
                IconChoice::render("exitSmall", "[12px]", "[12px]", "", "secondaryVariant", "darkSecondaryVariant", "background", "darkBackground", "secondary", "darkSecondary");
        echo '</button>';
    }
}
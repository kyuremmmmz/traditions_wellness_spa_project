<?php

namespace Project\App\Views\Php\Components\Containers;

use Project\App\Views\Php\Components\Texts\MiniOne;
use Project\App\Views\Php\Components\Texts\Text;

class Footer
{
    public static function render(?string $classname = null)
    {
?>
        <footer class="flex items-center justify-center w-full h-[80px] mt-[64px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo">
            <?php
            Text::render("", "", "MiniOne text-onBackgroundTwo dark:text-onBackgroundTwo text-center", "© 2025 Traditions Wellness Spa. <br> All Rights Reserved")
            ?>
        </footer>

<?php
    }
}
?>
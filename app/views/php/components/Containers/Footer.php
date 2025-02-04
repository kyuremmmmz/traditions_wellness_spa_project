<?php

namespace Project\App\Views\Php\Components\Containers;

use Project\App\Views\Php\Components\Texts\MiniOne;

class Footer
{
    public static function render(?string $classname = null)
    {
?>
        <footer class="flex items-center justify-center w-full h-[80px] mt-[64px] text-onBackgroundTwo dark:text-darkOnBackgroundTwo">
            <?php
            MiniOne::render("© 2025 Traditions Wellness Spa. <br> All Rights Reserved", "onBackgroundTwo", "darkOnBackgroundTwo", "center");
            ?>
        </footer>

<?php
    }
}
?>
<?php

namespace Project\App\Views\Php\Components;

class Footer
{
    public static function handle(?string $classname = null)
    {
?>
        <footer class="flex items-center justify-center w-full max-w-full min-w-full py-8 mi min-w- bg-background">
            <div class="px-8 text-sm text-center text-gray-400">
                © 2024 Traditions Wellness Spa.
                All Rights Reserved
            </div>
        </footer>

<?php
    }
}
?>
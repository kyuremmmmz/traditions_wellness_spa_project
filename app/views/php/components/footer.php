<?php

namespace Project\App\Views\Php\Components;

class Footer
{
    public static function handle(?string $classname = null)
    {
?>
        <footer class="flex items-center justify-center bg-primary py-8 w-full min-w-full">
            <div class="text-center text-gray-400 text-sm px-8">
                &copy; <?= date('Y'); ?> Traditions Wellness Spa. All rights reserved.
            </div>
        </footer>

<?php
    }
}
?>
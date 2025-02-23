<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Sidebar;

class Page
{
    public static function page()
    {
        ?>
        <main class="w-full flex">
            <?php Sidebar::render(); ?>
            <div class="ml-[48px]">
            </div>
        </main>
        <?php
    }
}

Page::page();

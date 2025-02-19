<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {
        ?>
        <main class="flex w-full">
            <?php Sidebar::render(); ?>
            <div class="ml-[48px]">
            </div>
        </main>
        <?php
    }
}

Page::page();

<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Container\DefaultContainer;
use Project\App\Views\Php\Components\Containers\Sidebar;


class Page
{
    public static function page()
    {
                ?>
                <main class="flex w-full gap-4">
                    <?php Sidebar::render();      
                    ?>
                    
                </main>
        <?php
    }
}

Page::page();

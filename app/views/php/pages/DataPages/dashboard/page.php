<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Sidebar;

class Page
{
    public static function page()
    {
        ?>
        <main class="flex w-full">
            <?php Sidebar::render(); ?>
            <div class=" grid grid-cols-5 grid-rows-5 ml-[48px] overflow-y-auto">
                <div>Analytics</div>
                <div>Table</div>
                <div>Total Users</div>
                <div>Appointments</div>
                <div>Users</div>
            </div>
        </main>
        <?php
    }
}

Page::page();

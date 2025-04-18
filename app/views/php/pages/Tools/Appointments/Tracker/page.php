<?php

namespace Project\App\Views\Php\Pages\Tools\Appointments\Tracker;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Table\Table;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {
?>
        <div class="overflow-y-auto px-[58px] flex flex-col mt-[104px] sm:mt-[160px] md:justify-start items-start w-full">
            <div class="flex flex-col gap-2 pb-[12px]">
                <?php
                WorkingBanner::render();
                Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Appointment Tracker');
                ?>
            </div>
            <form action="/updateAppointment" id="modalWrapper" method="post">

            </form>
            <?php
            Table::render('', 'tableWrapper');
            ?>
        </div>
<?php
        Sidebar::render();
    }
}
Page::page();

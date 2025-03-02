<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {
?>
        <main class="w-full flex items-center justify-center">
            <?php Sidebar::render(); ?>
            <div class="flex flex-col py-[243px]">
                <form class="flex flex-col gap-12" accept="" method="post">
                    <div class="flex flex-col gap-2">
                        <?php
                        Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Book an Appointment');
                        Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Please enter the following.');
                        ?>
                    </div>
                    <div class="">
                        <?php
                        Text::render('', '', 'text-[16px] font-[500] dark:text-white', '1. Session Details ');
                        
                        ?>
                    </div>
                    <div class="text-[16px]  flex justify-center">
                        <?php
                        GlobalButton::render('primary', 'Book', '', '', '', 'submit', 'appointmentButton');
                        ?>
                    </div>
                    <div>
                        <?php
                        
                        ?>
                    </div>
                </form>
            </div>
        </main>
<?php
    }
}

Page::page();

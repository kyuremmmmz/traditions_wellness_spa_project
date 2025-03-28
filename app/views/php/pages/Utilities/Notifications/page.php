<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Table\NotificationsTable;


class Page
{
    public static function page()
    {
        ?>
        <main class="flex w-full">
            <?php 
            Sidebar::render(); 
            WorkingBanner::render();
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] px-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen  w-full">
                <div>
                    <!-- Header Section -->
                    <section class="flex items-center mb-4">
                        <button type="button" class="min-w-[50px] min-h-[50px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground transition-all rounded-md flex justify-center items-center">
                            <?php IconChoice::render('clockMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="flex flex-col ml-3">
                            <?php 
                            echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left', 'Notifications');
                            echo LastUpdated::render(); 
                            ?>
                        </div>
                    </section>

                    <!-- Notifications -->
                    <section class="flex flex-col items-start w-full">
                        <?php NotificationsTable::render('', 'notificationstable'); ?>
                    </section>
                </div>
            </div>
        </main>
        <?php
    }
}

Page::page();

<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Inputs\SearchField;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
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
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[80px] sm:mt-[120px] w-full">
                <div>
                    <!-- Header Section -->
                    <section class="flex items-center mb-4">
                        <button type="button" class="min-w-[50px] min-h-[50px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-md flex justify-center items-center">
                            <?php IconChoice::render('clockMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="flex flex-col ml-3">
                            <?php 
                            echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left', 'Notifications');
                            echo LastUpdated::render(); 
                            ?>
                        </div>
                    </section>

                    <div class="border border-border border-[1px] dark:border-darkBorder rounded-[6px] w-[1000px]">
                        <table class="border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr class="p-0 m-0" style="margin: 0; padding: 0;">
                                <td class="p-0 m-0 border border-border dark:border-darkBorder border-[1px]">
                                    <section class="max-w-[1120px]">
                                        <?php NotificationsTable::render('notififcationsTable', ''); ?>
                                    </section>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php
    }
}

Page::page();

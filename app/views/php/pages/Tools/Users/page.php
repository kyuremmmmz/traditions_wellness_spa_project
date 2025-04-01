<?php
namespace Project\App\Views\Php\Pages\Tools\Users;

use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Inputs\SearchField;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Table\UsersTable;

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
                        <div type="button" class="min-w-[50px] min-h-[50px] border border-border dark:border-darkBorder bg-background dark:bg-darkBackground transition-all rounded-md flex justify-center items-center">
                            <?php IconChoice::render('clockMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </div>
                        <div class="flex flex-col ml-3">
                            <?php 
                            echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left', 'Users');
                            echo LastUpdated::render(); 
                            ?>
                        </div>
                    </section>

                    <!-- Search Bar -->
                    <section class="mb-3">
                        <?php SearchField::render('Search User', '') ?>
                    </section>


                    <div class="border border-border border-[1px] dark:border-darkBorder rounded-[6px] w-[1000px]">
                        <table class="border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr class="p-0 m-0" style="margin: 0; padding: 0;">
                                <td class="p-0 m-0 border border-border dark:border-darkBorder border-[1px]">
                                    <section class="p-[24px] flex gap-[16px] bg-[#FFEA06] bg-opacity-5 ">
                                    </section>
                                    <section class="max-w-[1120px]">
                                        <?php UsersTable::render('appointmentsTable', ''); ?>
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

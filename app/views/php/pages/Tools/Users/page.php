<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Inputs\SearchField;

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
                            echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left', 'Users');
                            echo LastUpdated::render(); 
                            ?>
                        </div>
                    </section>

                    <!-- Search Bar -->
                    <section class="mb-3">
                        <?php SearchField::render('Search User', '') ?>
                    </section>

                    <!-- Card Container -->
                    <div class="border border-border dark:border-darkBorder rounded-lg bg-background dark:bg-darkBackground shadow-sm">
                        <!-- Filter Section with Matching Background -->
                        <div class="bg-highlightSurface dark:bg-darkHighlightSurface px-6 py-3 rounded-t-lg flex items-center space-x-2">
                            <label class="text-onBackground dark:text-darkOnBackground text-sm">Filter user type by</label>
                            <select class="border border-border dark:border-darkBorder bg-transparent rounded-md px-3 py-1 text-onBackground dark:text-darkOnBackground">
                                <option class="bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">Therapist</option>
                                <option class="bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">Online Customer</option>
                                <option class="bg-background dark:bg-darkBackground text-onBackground dark:text-darkOnBackground">Guest Customer</option>
                            </select> ako muna
                        </div>

                        <!-- Table -->
                        <table class="w-full border-x border-b border-border dark:border-darkBorder rounded-lg overflow-hidden">
                            <!-- Table Header with Matching Background -->
                            <thead class="bg-highlightSurface dark:bg-darkHighlightSurface text-onBackground dark:text-darkOnBackground font-semibold">
                                <tr class="text-center">
                                    <th class="py-2 pb-10 pt-10">NO.</th>
                                    <th class="py-2 pb-10 pt-10">NAME</th>
                                    <th class="py-2 pb-10 pt-10">USER TYPE</th>
                                    <th class="py-2 pb-10 pt-10">GENDER</th>
                                    <th class="py-2 pb-10 pt-10">EMAIL</th>
                                </tr>
                            </thead>
                            <tbody class="text-onBackground dark:text-darkOnBackground text-sm divide-y divide-border dark:divide-darkBorder">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php
    }
}

Page::page();

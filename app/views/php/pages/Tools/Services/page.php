<?php

namespace Project\App\Views\Php\Pages\Tools\Services;

use Project\App\Controllers\Web\ServicesController;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\Text;

class Page
{
    public static function page()
    {

?>
        <main class="flex w-full bg-gray-50 dark:bg-gray-900 min-h-screen p-6">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
<<<<<<< Updated upstream
                <div id="topSection">
                    <section class="flex h-[50px]">
                        <button class="w-[50px] h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] pl-[8px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Create Service');
                        Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Details'); ?>
                        </div>
                    </section>
=======
                
                <!-- Header Section -->
                <section class="flex items-center gap-4">
                    <button class="w-[48px] h-[48px] border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all rounded-lg flex justify-center items-center shadow">
                        <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                    </button>
                    <div class="flex flex-col">
                        <?php 
                        echo Text::render('', '', 'text-2xl font-semibold text-gray-900 dark:text-gray-200', 'Create Service');
                        Text::render('', '', 'text-md text-gray-600 dark:text-gray-400', 'Details'); 
                        ?>
                    </div>
                </section>
>>>>>>> Stashed changes

                <!-- Form Start -->
                <form method="post" action="/createService" class="mt-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-xl max-w-lg mx-auto">
                    
                    <!-- Category Dropdown (Floating Label) -->
                <div class="relative mb-6">
                        <label for="category" class="absolute top-[-10px] left-3 bg-white dark:bg-gray-900 px-1 text-sm text-gray-600 dark:text-gray-400">
                            Category
                        </label>

<<<<<<< Updated upstream

                    <section class="flex mt-[24px]">
                        <?php Text::render('', '', 'BodyTwo leading-none text-onBackgroundTwo dark:text-darkOnBackgroundTwo mb-[24px]', 'Overview'); ?>
                    </section>
=======
                        <select id="category" name="category" required class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500 bg-white dark:bg-gray-800 pr-10">
                            <option value="massage">Massage</option>
                            <option value="facial">Facial</option>
                            <option value="spa">Spa</option>
                            <option value="haircut">Haircut</option>
                            <option value="nailcare">Nail Care</option>
                        </select>

                        <!-- Dropdown Icon -->
                        <svg class="w-5 h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400 pointer-events-none"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
>>>>>>> Stashed changes
                </div>


                    <!-- Input Fields with Floating Labels -->
                    <div class="flex flex-col gap-1">
                        <div class="relative">
                        <?php GlobalInputField::render('serviceName', 'Service Name', 'text', '', ''); ?>
                        </div>

                        <div class="relative">
                        <?php GlobalInputField::render('caption', 'Caption', 'text', '', ''); ?>
                        </div>

                        <div class="relative">
                        <?php GlobalInputField::render('description', 'Description', 'text', '', ''); ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 text-white font-semibold p-4 rounded-lg hover:bg-blue-700 transition">
                            Save Service
                        </button>
                    </div>
                    
                </form>

                <?php Sidebar::render(); ?>
            </div>
        </main>
<?php
    }
}

Page::page();

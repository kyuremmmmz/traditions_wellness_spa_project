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
    public static function render()
    {
?>
        <main class="flex w-full bg-gray-100 dark:bg-gray-900 min-h-screen">
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
                
                <!-- Top Section -->
                <section class="flex h-[50px] items-center gap-2">
                    <button class="w-[50px] h-[50px] border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all rounded-lg flex justify-center items-center shadow">
                        <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                    </button>
                    <div class="h-full flex flex-col justify-center w-[232px] pl-[48px] gap-[2px] ">
                        <?php
                        echo Text::render('', '', 'text-xl font-semibold text-gray-900 dark:text-gray-200', 'Create Service');
                        Text::render('', '', 'text-sm text-gray-600 dark:text-gray-400', 'Details');
                        ?>
                    </div>
                </section>
                
                <!-- Form Section -->
                <form method="post" action="/createService" class="mt-1">
                <div id="main" class="ml-[48px] overflow-y-auto px-[48px] pb-[24px] flex flex-col mt-[24px] mb-[24px] w-full">
                        <?php
                        GlobalInputField::render('category', 'Category', 'text', '', '');
                        GlobalInputField::render('serviceName', 'Service Name', 'text', '', '');
                        GlobalInputField::render('caption', 'Caption', 'text', '', '');
                        GlobalInputField::render('description', 'Description', 'text', '', '');
                        ?>
                    </div>
                </form>
                
                <!-- Sidebar -->
                <?php Sidebar::render(); ?>
            </div>
        </main>
<?php
    }
}

Page::render();

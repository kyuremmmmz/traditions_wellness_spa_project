<?php

namespace Project\App\Views\Php\Pages\Tools\Services;

use Project\App\Controllers\Web\ServicesController;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\PrimaryButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Inputs\SelectField;

class Page
{
    public static function page()
    {
        Sidebar::render();
        WorkingBanner::render();
        ?>

        <div class="overflow-auto flex flex-col mt-[104px] sm:mt-[160px] md:justify-center items-center w-full">
            <form class="flex flex-col gap-12" action="/createService" method="POST">
                <div class="flex flex-col gap-2">
                    <?php
                    Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Create a Service');
                    Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Details');
                    ?>
                </div>

                <div class="flex flex-col">
                    <?php
                    Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[0px]', 'Category');
                    $categories = ['Massage', 'Body Scrub', 'Stone Massage'];
                    ?>
                    <div class="flex flex-col gap-[24px] pb-[0px]">
                        <?php SelectField::render($categories, 'Category', 'categoryService', 'Select a category'); ?>
                    </div>

                    <?php
                    Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Service Name');
                    $services = ['Bamboossage Massage', 'Body Scrub', 'Stone Massage'];
                    ?>
                    <div class="flex flex-col gap-[24px] pb-[0px]">
                        <?php SelectField::render($services, 'Service Name', 'serviceName', 'Select a service'); ?>
                    </div>

                    <?php
                    Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Caption');
                    $captions = ['Relaxing Experience', 'Deep Cleansing', 'Rejuvenating Touch'];
                    ?>
                    <div class="flex flex-col gap-[24px] pb-[48px]">
                        <?php SelectField::render($captions, 'Caption', 'captionName', 'Select a caption'); ?>
                    </div>

                    <div class="flex flex-col gap-[24px] pb-[48px] w-full">
                        <?php Text::render('', '', 'text-[16px] font-[500] dark:text-white', 'Description'); ?>
                        <textarea name="description" placeholder="Enter your message..."
                            class="w-full h-[150px] border border-gray-400 rounded-md px-4 py-3 
                                   bg-transparent text-onBackground dark:text-white focus:outline-none resize-none"></textarea>
                    </div>
                </div>
            </form>
        </div>

        <?php
    }
}

Page::page();

<?php

namespace Project\App\Views\Php\Pages\Utilities\Personalinfo;

use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;


class Page
{
    public static function page()
    {

?>
        <main class="flex w-full">
            <div id="main" class="overflow-y-auto px-[48px] flex flex-col sm:items-center mt-[104px] sm:mt-[160px] w-full">
                <div id="topSection">
                <div class="flex justify-start mb-[48px] min-w-[316px] max-w-[400px] w-full">
                        <button id="closeAddANewServiceButton" class="transition-all duration-200 p-[4px] flex rounded-[6px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <div class="w-[24px] h-[24px] flex justify-center items-center">
                                <?php IconChoice::render('chevronRightSmall', '6px', '12px', '', 'onSurface', 'darkOnSurface', '', '', '', '', '', ''); ?>
                            </div>
                        </button>
                    </div>
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('settingsMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[8px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Account Settings');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>

                    <div class="border-border rounded-[6px] border-[1px] flex flex-col min-w-[316px] w-full max-w-[400px] mt-[24px]">
                        <a href="/personalinfo" class="flex min-w-[316px] w-full max-w-[400px]">
                            <button class="w-full rounded-tr-[5px] rounded-tl-[5px] h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                                <?php IconChoice::render('userSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                                Text::render('', '', 'BodyMediumTwo leading-none w-full text-onSurface dark:text-darkOnSurface px-[10px]', 'Personal Info');
                                IconChoice::render('chevronRightSmall', '[10px]', '[10px] rotate-180', '', 'onSurface', 'darkOnSurface');?>
                            </button>
                        </a>

                        <button class="w-inherit h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <?php IconChoice::render('activitiesSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                            Text::render('', '', 'BodyMediumTwo leading-none w-full text-onSurface dark:text-darkOnSurface px-[10px]', 'Activities');
                            IconChoice::render('chevronRightSmall', '[10px]', '[10px] rotate-180', '', 'onSurface', 'darkOnSurface');?>
                        </button>

                        <button class="w-inherit h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <?php IconChoice::render('securitySmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                            Text::render('', '', 'BodyMediumTwo leading-none w-full text-onSurface dark:text-darkOnSurface px-[10px]', 'Security');
                            IconChoice::render('chevronRightSmall', '[10px]', '[10px] rotate-180', '', 'onSurface', 'darkOnSurface');?>
                        </button>

                        <button class="w-inherit rounded-br-[5px] rounded-bl-[5px] h-[40px] text-left px-[10px] flex items-center BodyMediumTwo bg-background dark:bg-darkBackground text-onSurface dark:text-darkOnSurface hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface">
                            <?php IconChoice::render('reportTicketSmall', '[16px]', '[16px]', '', 'onSurface', 'darkOnSurface');
                            Text::render('', '', 'BodyMediumTwo leading-none w-full text-onSurface dark:text-darkOnSurface px-[10px]', 'Report Tickets');
                            IconChoice::render('chevronRightSmall', '[10px]', '[10px] rotate-180', '', 'onSurface', 'darkOnSurface');?>
                        </button>
                    </div>                 
                </div>
            </div>
            <?php Sidebar::render(); ?>
        </main>
        <?php
    }
}

Page::page();

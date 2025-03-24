<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;



class Page
{
    public static function page()
    {
                ?>
                <main class="flex w-full gap-4">
                    <?php Sidebar::render();      
                    ?>
                    <div id="main" class="sm:ml-[48px] overflow-y-auto sm:px-[0px] px-[48px] flex flex-col mt-[104px] sm:mt-[0px] sm:items-center sm:justify-center sm:h-screen  w-full">
                        <div>
                            <section class="flex h-[50px]">
                                <div class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground transition-all rounded-[6px] flex justify-center items-center">
                                    <?php IconChoice::render('dashboardMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                                </div>
                                <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                                    <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Dashboard');
                                    echo LastUpdated::render(); ?>
                                </div>
                            </section>
                            
                            <section>

                            </section>
                        </div>
                    </div>
                </main>
        <?php
    }
}

Page::page();

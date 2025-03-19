<?php
namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\Inputs\SecondaryInputField;
use Project\App\Views\Php\Components\Table\TherapistsTable;
use Project\App\Views\Php\Components\Texts\LastUpdated;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\SearchField;



class Page
{


    public static function page()
    {
        ?>
        <main class="flex w-full">
            <?php
            Sidebar::render();
            WorkingBanner::render()
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
                <div>
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('employeesSmall', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Therapist');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>

                    <section class="flex gap-[16px] py-[16px]">
                        <?php
                        ActionButton::render('plusSmall', 'Add a therapist', 'openAddANewServiceSectionButton');
                        SearchField::render('Search Therapist', '')
                        ?>
                    </section>

                    

                    <div class="border-border border-[1px] dark:border-darkBorder rounded-[6px] w-[1365px]">
                        <table class="border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground" style="border-radius: 6px; overflow: hidden; border-collapse: collapse; margin: 0; padding: 0;">
                            <tr class="p-0 m-0" style="margin: 0; padding: 0;">
                                <td class="p-0 m-0 border-border dark:border-darkBorder border-[1px]">
                                    <section class="p-[48px] flex gap-[16px] bg-[#FFEA06] bg-opacity-5">
                                        <?php
                                        SecondaryInputField::render('dropdownfield', 'Filter status by', '', ['Active', 'Inactive']);
                                        ?>
                                    </section>

                                    

                                    
                                    <section class="max-w-[1120px]">
                                        <?php TherapistsTable::render('therapistTable', '');
                                        ?>
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

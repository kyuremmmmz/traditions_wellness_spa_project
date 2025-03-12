<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Buttons\ActionButton;
use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\GridViewDefault\GridViewDefaultComponent;
use Project\App\Views\Php\Components\GridViewDefault\GridViewLocation;
use Project\App\Views\Php\Components\Inputs\DefaultInputField;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\StaticRadioButton;
use Project\App\Views\Php\Components\Texts\Text;
use Project\App\Views\Php\Components\Icons\IconChoice;
use Project\App\Views\Php\Components\Inputs\SearchField;
use Project\App\Views\Php\Components\Texts\LastUpdated;


class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <?php Sidebar::render();
            WorkingBanner::render()
            ?>
            <div id="main" class="sm:ml-[48px] overflow-y-auto sm:pl-[10%] px-[48px] flex flex-col mt-[104px] sm:mt-[160px] w-full">
                <div>
                    <section class="flex h-[50px]">
                        <button class="min-w-[50px] min-h-[50px] border-border dark:border-darkBorder border-[1px] bg-background dark:bg-darkBackground hover:bg-highlightSurface dark:hover:bg-darkHighlightSurface transition-all rounded-[6px] flex justify-center items-center">
                            <?php IconChoice::render('servicesMedium', '[24px]', '[24px]', '', 'onSurface', 'darkOnSurface'); ?>
                        </button>
                        <div class="h-full flex flex-col justify-center h-full w-[232px] min-w-[316px] pl-[16px] gap-[4px]">
                            <?php echo Text::render('', '', 'SubHeaderTwo text-onBackground dark:text-darkOnBackground text-left leading-none', 'Services');
                            echo LastUpdated::render(); ?>
                        </div>
                    </section>

                    <section class="flex gap-[16px] py-[16px]">
                        <?php 
                        ActionButton::render('calendarPlus', 'Book an appointment', 'placeOnClickHere'); 
                        SearchField::render('Search Customer', '')
                        ?>
                    </section>
                    <div class="flex border border-border dark:border-darkBorder border-[1px] rounded-[6px]">
                        <section>
                            
                        </section>
                    </div>
                </div>
            </div>
            <div class="hidden">
                <form class="flex flex-col gap-12" action="/appointCustomer" method="POST">
                    <div class="flex flex-col gap-2">
                        <?php
                        Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Book an Appointment');
                        Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Please enter the following.');
                        ?>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Source. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Where did the booking come from?');
                            ?>
                        </div>
                        <div class="pb-[64px]">
                            <?php GridViewDefaultComponent::render() ?>
                        </div>
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Location. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Where will the service take place?');
                            ?>
                        </div>
                        <div class="">
                            <?php GridViewLocation::render() ?>
                        </div>
                    </div>
                    <div class="flex flex-col pb-[48px]">
                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Service. ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What will be booked?');
                            ?>
                        </div>
                        <div id="select" class="flex flex-col gap-[16px] FieldContainer min-w-[316px] w-full max-w-[400px] pb-[64px]">

                        </div>

                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Add-ons.  ');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Are there special requests?');
                            ?>
                        </div>
                        <div class="pb-[64px]">
                            <?php StaticRadioButton::render() ?>
                        </div>

                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Date.');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What day will it happen?');
                            ?>
                        </div>
                        <div class=" pb-[64px]">
                            <?php GlobalInputField::render('date', 'Select date', 'date', ''); ?>
                        </div>

                        <div class="flex flex-row gap-2">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Time.');
                            Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' What time will it start?');
                            ?>
                        </div>
                        <div class=" pb-[64px]">
                            <?php GlobalInputField::render('time', 'Select time', 'time', ''); ?>
                        </div>

                        <div class="flex flex-col w-full">
                            <div class="flex flex-row gap-2">
                                <?php
                                Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', 'Customer.  ');
                                Text::render('', '', 'text-[16px] font-[400] dark:text-white pb-[24px]', ' Who is the client?');
                                ?>
                            </div>
                            <?php

                            DefaultInputField::render('SearchCustomer', 'Search for existing customer', 'text', 'search', '', '',);
                            ?>
                            <div id="hiddenValue">
                            </div>
                            <div class=" rounded-xl bg-primary hover:bg-slate-500 cursor-pointer w-[325px]" id="wrapper">
                                <ul class="hover:bg-slate-400" id="suggestions">
                                    <li id="li"></li>
                                </ul>
                            </div>
                            <div class=" py-[10px]">
                                <?php DefaultInputField::render('guestCustomer', 'Add a guest customer', 'text', 'm', '', '',); ?>
                            </div>
                        </div>
                        
                        <div class="text-[16px]  flex justify-center pt-[148px]">
                            <?php
                            GlobalButton::render(
                                'primary',
                                'Book',
                                '',
                                '',
                                '',
                                'submit',
                                'appointmentButton',
                            );
                            ?>
                        </div>
                </form>
            </div>
        </main>
<?php
    }
}

Page::page();

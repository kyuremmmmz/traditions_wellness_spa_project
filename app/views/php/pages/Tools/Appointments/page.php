<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\DatePicker\DatePicker;
use Project\App\Views\Php\Components\GridViewDefault\GridViewDefaultComponent;
use Project\App\Views\Php\Components\GridViewDefault\GridViewLocation;
use Project\App\Views\Php\Components\Inputs\DefaultInputField;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\SelectField;
use Project\App\Views\Php\Components\Inputs\StaticRadioButton;
use Project\App\Views\Php\Components\Texts\Text;

use function Symfony\Component\Clock\now;

class Page
{
    public static function page()
    {
?>
        <main class="flex w-full">
            <?php Sidebar::render();
            WorkingBanner::render()
            ?>
            <div class=" overflow-y-auto  flex flex-col mt-[104px] sm:mt-[102px] md:justify-center items-center w-full">
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

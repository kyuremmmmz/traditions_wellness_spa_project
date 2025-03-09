<?php

namespace Project\App\Views\Php\Pages\Dashboard;

use Project\App\Views\Php\Components\Banners\WorkingBanner;
use Project\App\Views\Php\Components\Buttons\GlobalButton;
use Project\App\Views\Php\Components\Containers\Header;
use Project\App\Views\Php\Components\Containers\Sidebar;
use Project\App\Views\Php\Components\DatePicker\DatePicker;
use Project\App\Views\Php\Components\Inputs\DefaultInputField;
use Project\App\Views\Php\Components\Inputs\GlobalInputField;
use Project\App\Views\Php\Components\Inputs\SelectField;
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
            <div class=" overflow-y-auto  flex flex-col mt-[104px] sm:mt-[160px] md:justify-center items-center w-full">
                <form class="flex flex-col gap-12" action="/appointCustomer" method="POST">
                    <div class="flex flex-col gap-2">
                        <?php
                        Text::render('', '', 'text-onBackground dark:text-white text-[22px] font-[600]', 'Book an Appointment');
                        Text::render('', '', 'text-onBackground dark:text-white text-[14px] font-[400]', 'Please enter the following.');
                        ?>
                    </div>
                    <div class="flex flex-col">
                        <?php
                        Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '1. Session Details ');
                        $options = array(
                            'Select',
                            'Walk-in',
                            'Chat',
                            'Call'
                        );
                        $options2 = array(
                            'Select',
                            'Home',
                            'Branch'
                        );
                        ?>
                        <div class="flex flex-col gap-[24px] pb-[48px]">
                            <?php
                            SelectField::render($options, 'Source of appointment', 'sourceOfAppointment', 'ewan');
                            SelectField::render($options2, 'Type of appointment', 'typeOfAppointment', 'what');
                            ?>
                        </div>
                            </div>
                        <div class="flex flex-col pb-[48px]">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '2. Service Choice');
                            SelectField::render([], 'Package', 'service_id', 'select');
                            ?>
                        </div>
                        <div class="flex flex-col w-full">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '3. Customer Details');
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
                        <div class=" flex flex-col py-[48px]">
                            <?php
                            Text::render('', '', 'text-[16px] font-[500] dark:text-white pb-[24px]', '4. Therapist Choice, Date, & Time');
                            ?>
                            <div class="flex flex-col gap-[24px]">
                                <?php
                                GlobalInputField::render('date', 'Select date', 'date', '');
                                GlobalInputField::render('time', 'Select time', 'time', '');
                                ?>
                                <div class="" id="wrapperDom"></div>
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
